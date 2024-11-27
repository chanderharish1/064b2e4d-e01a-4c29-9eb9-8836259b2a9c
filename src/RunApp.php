<?php

require_once 'Report.php';
require_once 'ReadUserInput.php';
require_once 'ValidateUserInput.php';

echo "Please enter the following: \n";

$readUserInput = new ReadUserInput();
$validate = new ValidateUserInput();

// Read valid student id
$validStudentId = false;
while (!$validStudentId) {
    $readUserInput->readStudentId();
    $studentId = $readUserInput->getStudentId();
    $validStudentId = $validate->validateStudentId($studentId);
}

// Read valid report id
$validReportId = false;
while (!$validReportId) {
    $readUserInput->readReportId();
    $reportId = $readUserInput->getReportId();
    $validReportId = $validate->validateReportId($reportId);
}

// Run report
$report = new Report($studentId, $reportId);
$report->executeReport();
