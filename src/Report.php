<?php

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

    private string $studentId;
    private int $reportId;

    public function __construct($studentId, $reportId)
    {
        $this->studentId = $studentId;
        $this->reportId = $reportId;
    }
}