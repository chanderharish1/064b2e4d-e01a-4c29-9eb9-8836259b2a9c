<?php

require_once __DIR__ . '/../src/ReadData.php';

class StudentsTest extends PHPUnit\Framework\TestCase
{
    private ReadData $readData;
    private array $students;

    protected function setUp(): void
    {
        $this->readData = new ReadData();
        $this->students = $this->readData->getStudents();
    }

    public function testOutput()
    {
        $this->assertIsArray($this->students);
        foreach($this->students as $student) {
            $this->assertArrayHasKey('id', $student);
            $this->assertArrayHasKey('firstName', $student);
            $this->assertArrayHasKey('lastName', $student);
            $this->assertArrayHasKey('yearLevel', $student);
        }
    }
}
?>
