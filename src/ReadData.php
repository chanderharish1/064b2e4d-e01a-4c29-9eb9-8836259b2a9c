<?php

require_once 'Report.php';

class ReadData
{
    private string $students = '';
    private string $questions = '';
    private string $student_responses = '';
    private string $assessments = '';

    public function __construct()
    {
        $this->students = Report::PROJECT_DIRECTORY . "/data/students.json";
        $this->questions = Report::PROJECT_DIRECTORY . "/data/questions.json";
        $this->student_responses = Report::PROJECT_DIRECTORY . "/data/student-responses.json";
        $this->assessments = Report::PROJECT_DIRECTORY . "/data/assessments.json";
    }

    /**
     * Get students
     */
    public function getStudents(): array
    {
        $this->isFileReadable($this->students);
        $getStudentsContents = file_get_contents($this->students);
        $result = json_decode($getStudentsContents, true);
        
        return $result;
    }

    /**
     * Get questions
     */
    public function getQuestions(): array
    {
        $this->isFileReadable($this->questions);
        $getQuestionsContents = file_get_contents($this->questions);
        $result = json_decode($getQuestionsContents, true);
        
        return $result;
    }

    /**
     * Get student responses
     */
    public function getStudentResponses(): array
    {
        $this->isFileReadable($this->student_responses);
        $getStudentResponsesContents = file_get_contents($this->student_responses);
        $result = json_decode($getStudentResponsesContents, true);
        
        return $result;
    }

    /**
     * Get sessessments
     */
    public function getAssessments(): array
    {
        $this->isFileReadable($this->assessments);
        $getAssessmentsContents = file_get_contents($this->assessments);
        $result = json_decode($getAssessmentsContents, true);
        
        return $result;
    }

    /**
     * Is file readable
     */
    private function isFileReadable($file_path)
    {
        if (is_file($file_path)) {
            if (is_readable($file_path)) {
                $lines = file($file_path, FILE_IGNORE_NEW_LINES);
            } else {
                die("Error: assessments.json file cannot be read " . $file_path);
            }
        } else {
            die("Error: assessments.json file doesn't exist " . $file_path);
        }
    }
}
