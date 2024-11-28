<?php

require_once __DIR__ . '/../src/ReadData.php';

class AssessmentsTest extends PHPUnit\Framework\TestCase
{
    private ReadData $readData;
    private array $assessments;

    protected function setUp(): void
    {
        $this->readData = new ReadData();
        $this->assessments = $this->readData->getAssessments();
    }

    public function testOutput()
    {
        $this->assertIsArray($this->assessments);
        foreach($this->assessments as $assessment) {
            $this->assertArrayHasKey('id', $assessment);
            $this->assertArrayHasKey('name', $assessment);
            $this->assertArrayHasKey('questions', $assessment);
            foreach($assessment['questions'] as $question) {
                $this->assertArrayHasKey('questionId', $question);
                $this->assertArrayHasKey('position', $question);

            }
        }
    }
}
?>
