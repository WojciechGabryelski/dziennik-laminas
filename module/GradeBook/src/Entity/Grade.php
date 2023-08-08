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
     * @ORM\Column(type="datetime")
     */
    #[ORM\Column(type: 'datetime')]
    private DateTime $date;
    /**
     * @var StudentCourse
     * @ORM\ManyToOne(targetEntity="StudentCourse")
     * @ORM\JoinColumn(name="student_course_id")
     */
    #[ORM\ManyToOne(targetEntity: StudentCourse::class)]
    #[ORM\JoinColumn(name: 'student_course_id')]
    private StudentCourse $studentCourse;

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
     * @return StudentCourse
     */
    public function getStudentCourse(): StudentCourse
    {
        return $this->studentCourse;
    }

    /**
     * @param StudentCourse $studentCourse
     */
    public function setStudentCourse(StudentCourse $studentCourse): void
    {
        $this->studentCourse = $studentCourse;
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
        if (!empty($data['studentCourse']) && gettype($data['studentCourse']) != 'integer') {
            $this->studentCourse = $data['studentCourse'];
        }
    }

    public function getArrayCopy(): array
    {
        return [
            'id' => $this->id,
            'value' => $this->value,
            'wage' => $this->wage,
            'date' => $this->date,
            'studentCourse' => $this->studentCourse->getId(),
        ];
    }
}