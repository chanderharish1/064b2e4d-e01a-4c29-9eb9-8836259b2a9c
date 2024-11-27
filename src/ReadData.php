<?php

require_once 'Report.php';

class ReadData
{
    private string $students = '';

    public function __construct()
    {
        $this->students = Report::PROJECT_DIRECTORY . "/data/students.json";
    }

    /**
     * Get students
     */
    public function getStudents(): array
    {
        if (is_file($this->students)) {
            if (is_readable($this->students)) {
                $lines = file($this->students, FILE_IGNORE_NEW_LINES);
            } else {
                die("Error: Students file cannot be read ");
            }
        } else {
            die("Error: Students file doesn't exist " . $this->students);
        }

        $getStudentsContents = file_get_contents($this->students);
        $result = json_decode($getStudentsContents, true);
        
        return $result;
    }
}
