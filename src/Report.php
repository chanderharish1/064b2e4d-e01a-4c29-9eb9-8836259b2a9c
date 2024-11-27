<?php

require_once 'ReadData.php';
class Report
{
    // Update the Project Directory '/Users/Username/Path_To_Project_Root'
    public const PROJECT_DIRECTORY = "/Users/harish/Projects/064b2e4d-e01a-4c29-9eb9-8836259b2a9c";

    public const DIAGNOSTIC = 1;
    public const PROGRESS = 2;
    public const FEEDBACK = 3;

    public const REPORTING_OPTIONS = [
        self::DIAGNOSTIC,
        self::PROGRESS,
        self::FEEDBACK
    ];

    public const NUMBER_AND_ALGEBRA = "Number and Algebra";
    public const MEASUREMENT_AND_GEOMETRY = "Measurement and Geometry";
    public const STATISTICS_AND_PROBABILITY = "Statistics and Probability";

    private ReadData $readData;

    private string $student_id;
    private int $report_id;

    private array $students;
    private array $assessments;
    private array $questions;
    private array $student_responses;

    private string $student_first_name;
    private string $student_last_name;
    private string $assessment_id;
    private string $assessment_name;
    private string $recent_date;
    private array $latest_student_response;

    public function __construct($student_id, $report_id)
    {
        $this->readData = new ReadData();

        $this->student_id = $student_id;
        $this->report_id = $report_id;

        $this->students = $this->readData->getStudents();
        $this->assessments = $this->readData->getAssessments();
        $this->questions = $this->readData->getQuestions();
        $this->student_responses = $this->readData->getStudentResponses();

        $this->recent_date = '';
        $this->latest_student_response = [];
        $this->student_first_name = '';
        $this->student_last_name = '';
        $this->assessment_id = '';
        $this->assessment_name = '';

        $this->setStudentFullName();
    }

    /**
     * Run Report
     */
    public function runReport()
    {
        if ($this->report_id === Report::DIAGNOSTIC) {
            $this->generateDiagnosticReport();
        }
        if ($this->report_id === Report::PROGRESS) {
            $this->generateProgressReport();
        }
        if ($this->report_id === Report::FEEDBACK) {
            $this->generateFeedbackReport();
        }
    }

    /**
     * Generate Diagnostic Report
     */
    public function generateDiagnosticReport()
    {
        $output = array();

        // 1.1 Determining recent date for assessment with student responses
        foreach ($this->student_responses as $student_response) {
            if (!empty($student_response['completed']) && $student_response['student']['id'] == $this->student_id){
                if($student_response['completed'] > $this->recent_date) {
                    $this->recent_date = $student_response['completed'];
                }
            }
        }

        // 1.2 Find assessment id for latest student response
        foreach ($this->student_responses as $student_response) {
            if (
                !empty($this->recent_date) &&
                !empty($student_response['completed']) && 
                $student_response['completed'] == $this->recent_date && 
                $student_response['student']['id'] == $this->student_id
            ){
                $this->assessment_id = $student_response['assessmentId'];
                $this->latest_student_response = $student_response;
            }
        }

        // 1.3 Find assessment name by assessment id for lates student response
        foreach($this->assessments as $assessment) {
            if (!empty($this->assessment_id) && $assessment['id'] == $this->assessment_id) {
                $this->assessment_name = $assessment['name'];
            }
        }

        $line1 = "\n" . $this->getStudentFullName() . " recently completed " . $this->assessment_name . " assessment on " . date('jS F Y h:i A', strtotime(str_replace('/', '-', $this->recent_date))) . "\n";
        array_push($output, $line1);

        // 2 Find overall results
        $line2 = "He got " . $this->latest_student_response['results']['rawScore'] . " question right out of " . count($this->latest_student_response['responses']) . ". Details by strand given below:\n\n";
        array_push($output, $line2);

        // 3. Find out Details by strand
        $number_and_algebra_correct_count = 0;
        $number_and_algebra_total_count = 0;
        $measurement_and_geometry_correct_count = 0;
        $measurement_and_geometry_total_count = 0;
        $statistics_and_probability_correct_count = 0;
        $statistics_and_probability_total_count = 0;
        foreach($this->latest_student_response['responses'] as $answer) {
            foreach($this->questions as $question) {
                if ($answer['questionId'] == $question['id']){
                    if ($question['strand'] == self::NUMBER_AND_ALGEBRA) {
                        if ($answer['response'] == $question['config']['key']){
                            $number_and_algebra_correct_count++;
                            $number_and_algebra_total_count++;
                        } else {
                            $number_and_algebra_total_count++;
                        }
                    }
                    if ($question['strand'] == self::MEASUREMENT_AND_GEOMETRY) {
                        if ($answer['response'] == $question['config']['key']){
                            $measurement_and_geometry_correct_count++;
                            $measurement_and_geometry_total_count++;
                        } else {
                            $measurement_and_geometry_total_count++;
                        }
                    }
                    if ($question['strand'] == self::STATISTICS_AND_PROBABILITY) {
                        if ($answer['response'] == $question['config']['key']){
                            $statistics_and_probability_correct_count++;
                            $statistics_and_probability_total_count++;
                        } else {
                            $statistics_and_probability_total_count++;
                        }
                    }
                }
            }
        }

        $line3 = self::NUMBER_AND_ALGEBRA . ": " . $number_and_algebra_correct_count . " out of " . $number_and_algebra_total_count . " correct\n";
        array_push($output, $line3);
        $line4 = self::MEASUREMENT_AND_GEOMETRY . ": " . $measurement_and_geometry_correct_count . " out of " . $measurement_and_geometry_total_count . " correct\n";
        array_push($output, $line4);
        $line5 = self::STATISTICS_AND_PROBABILITY . ": " . $statistics_and_probability_correct_count . " out of " . $statistics_and_probability_total_count . " correct\n\n";
        array_push($output, $line5);

        // 4. Display output
        $this->displayOnConsole($output);

    }
    /**
     * Generate Progress Report
     */
    public function generateProgressReport()
    {
        
    }
    /**
     * Generate Feedback Report
     */
    public function generateFeedbackReport()
    {
        echo "Feedback Report in-progress.";
    }

    public function displayOnConsole($output) 
    {
        foreach($output as $line) {
            echo $line;
        }
    }

    public function setStudentFullName(): void
    {
        foreach ($this->students as $student) {
            if ($student['id'] == $this->student_id) {
                $this->student_first_name = $student['firstName'];
                $this->student_last_name = $student['lastName'];
            }
        }
    }

    public function getStudentFullName(): string
    {
        return $this->student_first_name . " " . $this->student_last_name;
    }
}
