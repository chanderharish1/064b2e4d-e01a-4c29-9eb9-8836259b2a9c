<?php

require_once __DIR__ . '/../src/ReadData.php';

class QuestionsTest extends PHPUnit\Framework\TestCase
{
    private ReadData $readData;
    private array $questions;

    protected function setUp(): void
    {
        $this->readData = new ReadData();
        $this->questions = $this->readData->getQuestions();
    }

    public function testOutput()
    {
        $this->assertIsArray($this->questions);
        foreach($this->questions as $question) {
            $this->assertArrayHasKey('id', $question);
            $this->assertArrayHasKey('stem', $question);
            $this->assertArrayHasKey('type', $question);
            $this->assertArrayHasKey('strand', $question);
            $this->assertArrayHasKey('config', $question);
            $this->assertArrayHasKey('options', $question['config']);
            $this->assertArrayHasKey('key', $question['config']);
            $this->assertArrayHasKey('hint', $question['config']);
                foreach($question['config']['options'] as $option) {
                    $this->assertArrayHasKey('id', $option);
                    $this->assertArrayHasKey('label', $option);
                    $this->assertArrayHasKey('value', $option);
                }
        }
    }
}
?>
