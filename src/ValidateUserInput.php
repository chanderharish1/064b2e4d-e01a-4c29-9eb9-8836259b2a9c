<?php

require_once 'Report.php';
require_once 'ReadData.php';

class ValidateUserInput
{
    private ReadData $readData;

    public function __construct()
    {
        $this->readData = new ReadData();
    }

    /**
     * Validate student id
     */
    public function validateStudentId($studentId): bool
    {
        $students = $this->readData->getStudents();
        $validStudentIds = array_column($students, 'id');

        return in_array($studentId, $validStudentIds) ? true : false;
    }

    /**
     * Validate report id
     */
    public function validateReportId($reportId): bool
    {
        return in_array($reportId, Report::REPORTING_OPTIONS) ? true : false;
    }
}