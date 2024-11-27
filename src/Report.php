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
    private string $studentId;
    private int $reportId;
    private array $students;
    private array $assessments;
    private array $questions;
    private array $student_responses;

    public function __construct($studentId, $reportId)
    {
        $this->readData = new ReadData();
        $this->studentId = $studentId;
        $this->reportId = $reportId;
        $this->students = $this->readData->getStudents();
        $this->assessments = $this->readData->getAssessments();
        $this->questions = $this->readData->getQuestions();
        $this->student_responses = $this->readData->getStudentResponses();
    }

    /**
     * Run Report
     */
    public function runReport()
    {
        if ($this->reportId === Report::DIAGNOSTIC) {
            $this->generateDiagnosticReport();
        }
        if ($this->reportId === Report::PROGRESS) {
            $this->generateProgressReport();
        }
        if ($this->reportId === Report::FEEDBACK) {
            $this->generateFeedbackReport();
        }
    }

    /**
     * Generate Diagnostic Report
     */
    public function generateDiagnosticReport()
    {
        
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