<?php

class ReadUserInput
{
    private string $studentId;
    private int $reportId;

    public function __construct()
    {
        $this->studentId = '';
    }

    /**
     * Read student id
     */
    public function readStudentId()
    {
        try {
            $this->studentId = readline('Student ID: ');
            if(gettype($this->studentId) != 'string'){
                throw new Exception("Value must be of string type. \n");
            }
        }
        catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        return $this->studentId;
    }

    /**
     * Get student id
     */
    public function getStudentId(): string
    {
        return $this->studentId;
    }

    /**
     * Read report id
     */
    public function readReportId()
    {
        try {
            $this->reportId = (int) readline('Report to generate (1 for Diagnostic, 2 for Progress, 3 for Feedback): ');
            if(gettype($this->reportId) != 'integer'){
                throw new Exception("Value must be an integer. Value should be 1 or 2 or 3.\n");
            }
        }
        catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }

    /**
     * Get report id
     */
    public function getReportId(): string
    {
        return $this->reportId;
    }
}
