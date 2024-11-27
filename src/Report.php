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

    private ReadData $readData;
    private string $student_id;
    private int $report_id;
    private array $students;
    private array $assessments;
    private array $questions;
    private array $student_responses;
    private string $recent_date;

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

        // Find student first and last name
        $student_first_name = '';
        $student_last_name = '';
        foreach ($this->students as $student) {
            if ($student['id'] == $this->student_id) {
                $student_first_name = $student['firstName'];
                $student_last_name = $student['lastName'];
            }
        }

        // Determine recent date from the student responses
        foreach ($this->student_responses as $student_reponse) {
            if (!empty($student_reponse['completed']) && $student_reponse['student']['id'] == $this->student_id){
                if($student_reponse['completed'] > $this->recent_date) {
                    $this->recent_date = $student_reponse['completed'];
                }
            }
        }

        // Find assessment id for recent assessment
        $assessment_id = '';
        foreach ($this->student_responses as $student_reponse) {
            if (!empty($student_reponse['completed']) && $student_reponse['completed'] == $this->recent_date && $student_reponse['student']['id'] == $this->student_id){
                $assessment_id = $student_reponse['assessmentId'];
            }
        }

        // Find assessment name using assessment id
        $assessment_name = '';
        foreach($this->assessments as $assessment) {
            if (!empty($assessment_id) && $assessment['id'] == $assessment_id) {
                $assessment_name = $assessment['name'];
            }
        }

        $row = $student_first_name . " " . $student_last_name . " recently completed " . $assessment_name . " assessment on " . date('jS F Y h:i A', strtotime(str_replace('/', '-', $this->recent_date)));
        array_push($output, $row);

        

    }
    /**
     * Generate Progress Report
     */
    public function generateProgressReport()
    {
        echo "Progress Report in-progress.";
    }
    /**
     * Generate Feedback Report
     */
    public function generateFeedbackReport()
    {
        echo "Feedback Report in-progress.";
    }
}