<?php
// Как низкоуровневый монолит из пяти строк, который не особо понятен, привести в нормальный вид?
$rows = file(__DIR__ . '/list.txt');
foreach ($rows as $row) {
    $values = array_map('trim', explode(';', $row));
    echo $values[0] . ' ' . $values[1] . ' ' . $values[2] . PHP_EOL;
}

// =============================================================================
class Student
{
    public string $lastName;
    public string $firstName;
    public DateTime $birthDate;

    public function __construct(string $lastName, string $firstName, DateTime $birthDate)
    {
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->birthDate = $birthDate;
    }

    public function getFullName(): string
    {
        return $this->lastName . ' ' . $this->firstName;
    }
}

interface StudentRepository
{
    public function findAll(): array;
}

class TXTStudentRepository implements StudentRepository
{
    private string $file;

    public function __construct(string $file)
    {
        $this->file = $file;
    }

    /**
     * @throws Exception
     */
    public function findAll(): array
    {
        $students = [];
        foreach (file($this->file) as $row) {
            $values = array_map('trim', explode(';', $row));
            $students[] = new Student($values[0], $values[1], new DateTime($values[2]));
        }

        return $students;
    }

    public function saveAll(array $students)
    {
        $rows = [];
        foreach ($students as $student) {
            $rows[] = implode(';', [
                $student->lastName,
                $student->firstName,
                $student->birthDate,
            ]);
        }
        file_put_contents($this->file, implode(PHP_EOL, $rows));
    }
}

class XMLStudentRepository implements StudentRepository
{
    private string $file;

    public function __construct(string $file)
    {
        $this->file = $file;
    }

    /**
     * @throws Exception
     */
    public function findAll(): array
    {
        $students = [];
        foreach (simplexml_load_file($this->file) as $row) {
            $students[] = new Student($row->lastName, $row->firstName, new DateTime($row->birthDate));
        }

        return $students;
    }
}

class RepositoryFactory
{
    public static function create($type, $file): StudentRepository
    {
        switch ($type) {
            case 'txt':
                $studentRepository = new TXTStudentRepository($file);
                break;
            case 'xml':
                $studentRepository = new XMLStudentRepository($file);
                break;
            default:
                die('Incorrect type ' . $type);
        }

        return $studentRepository;
    }
}
// ==============================================================================
$type = 'txt';
$file = __DIR__ . '/list.txt';

$studentRepository = RepositoryFactory::create($type, $file);

// ==============================================================================
$students = $studentRepository->findAll();
foreach ($students as $student) {
    echo $student->getFullName() . ' ' . $student->birthDate->format('d.m.y') . PHP_EOL;
}