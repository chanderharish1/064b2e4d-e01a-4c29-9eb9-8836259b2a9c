<?php

require_once __DIR__ . '/../src/ReadData.php';

class StudentResponsesTest extends PHPUnit\Framework\TestCase
{
    private ReadData $readData;
    private array $student_responses;

    protected function setUp(): void
    {
        $this->readData = new ReadData();
        $this->student_responses = $this->readData->getStudentResponses();
    }

    public function testOutput()
    {
        $student_response = $this->student_responses[0];
        
        $this->assertIsArray($this->student_responses);
        $this->assertArrayHasKey('id', $student_response);
        $this->assertArrayHasKey('assessmentId', $student_response);
        $this->assertArrayHasKey('assigned', $student_response);
        $this->assertArrayHasKey('started', $student_response);
        $this->assertArrayHasKey('completed', $student_response);
        $this->assertArrayHasKey('student', $student_response);
        $this->assertArrayHasKey('responses', $student_response);
        $this->assertArrayHasKey('results', $student_response);

        $this->assertArrayHasKey('rawScore', $student_response['results']);

        $this->assertArrayHasKey('id', $student_response['student']);
        $this->assertArrayHasKey('yearLevel', $student_response['student']);

        $this->assertArrayHasKey('questionId', $student_response['responses'][0]);
        $this->assertArrayHasKey('response', $student_response['responses'][0]);
    }
}
?>
