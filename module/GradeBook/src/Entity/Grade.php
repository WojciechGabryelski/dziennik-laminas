<?php

namespace GradeBook\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use GradeBook\Entity\Repository\GradeRepository;

/**
 * @ORM\Entity(repositoryClass="GradeRepository")
 * @ORM\Table(name="grades")
 */
#[ORM\Entity(repositoryClass: GradeRepository::class)]
#[ORM\Table(name: 'grades')]
class Grade
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int $id;
    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    #[ORM\Column(type: 'integer')]
    private int $value;
    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    #[ORM\Column(type: 'integer')]
    private int $wage;
    /**
     * @var DateTime
     * @ORM\Column(type="date")
     */
    #[ORM\Column(type: 'date')]
    private DateTime $date;
    /**
     * @var Student
     * @ORM\ManyToOne(targetEntity="Student", inversedBy="grades")
     */
    #[ORM\ManyToOne(targetEntity: Student::class, inversedBy: 'grades')]
    private Student $student;
    /**
     * @var Course
     * @ORM\ManyToOne(targetEntity="Course", inversedBy="grades")
     */
    #[ORM\ManyToOne(targetEntity: 'Course', inversedBy: 'grades')]
    private Course $course;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @param int $value
     */
    public function setValue(int $value): void
    {
        $this->value = $value;
    }

    /**
     * @return int
     */
    public function getWage(): int
    {
        return $this->wage;
    }

    /**
     * @param int $wage
     */
    public function setWage(int $wage): void
    {
        $this->wage = $wage;
    }

    /**
     * @return DateTime
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * @param DateTime $date
     */
    public function setDate(DateTime $date): void
    {
        $this->date = $date;
    }

    /**
     * @return Course
     */
    public function getCourse(): Course
    {
        return $this->course;
    }

    /**
     * @param Course $course
     */
    public function setCourse(Course $course): void
    {
        $this->course = $course;
    }

    /**
     * @return Student
     */
    public function getStudent(): Student
    {
        return $this->student;
    }

    /**
     * @param Student $student
     */
    public function setStudent(Student $student): void
    {
        $this->student = $student;
    }

    public function exchangeArray(array $data): void {
        if (!empty($data['id'])) {
            $this->id = $data['id'];
        }
        if (!empty($data['value'])) {
            $this->value = $data['value'];
        }
        if (!empty($data['wage'])) {
            $this->wage = $data['wage'];
        }
        if (!empty($data['date'])) {
            $this->date = $data['date'];
        }
        if (!empty($data['student'])) {
            $this->student = $data['student'];
        }
        if (!empty($data['course'])) {
            $this->course = $data['course'];
        }
    }

    public function getArrayCopy(): array
    {
        return [
            'id' => $this->id,
            'value' => $this->value,
            'wage' => $this->wage,
            'date' => $this->date,
            'student' => $this->student,
            'course' => $this->course,
        ];
    }
}