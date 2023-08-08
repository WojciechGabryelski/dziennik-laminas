<?php

namespace GradeBook\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="students_courses")
 */
#[ORM\Entity]
#[ORM\Table(name: 'students_courses')]
class StudentCourse
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
     * @var Student
     * @ORM\ManyToOne(targetEntity="Student")
     */
    #[ORM\ManyToOne(targetEntity: Student::class)]
    private Student $student;
    /**
     * @var Course
     * @ORM\ManyToOne(targetEntity="Course")
     */
    #[ORM\ManyToOne(targetEntity: Course::class)]
    private Course $course;
    /**
     * @var Collection
     * @ORM\OneToMany(mappedBy="studentCourse", targetEntity="Grade")
     */
    #[ORM\OneToMany(mappedBy: 'studentCourse', targetEntity: Grade::class)]
    private Collection $grades;

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

    /**
     * @return Collection
     */
    public function getGrades(): Collection
    {
        return $this->grades;
    }

    /**
     * @param Grade $grade
     */
    public function setGrades(Grade $grade): void
    {
        $this->grades[] = $grade;
    }

    public function exchangeArray(array $data): void
    {
        if (!empty($data['student'])) {
            $this->student = $data['student'];
        }
        if (!empty($data['course'])) {
            $this->course = $data['course'];
        }
        if (!empty($data['id'])) {
            $this->id = $data['id'];
        }
        if (!empty($data['grades'])) {
            $this->grades = $data['grades'];
        }
    }

    public function getArrayCopy(): array
    {
        return [
            'student' => $this->student,
            'course'  => $this->course,
            'id'      => $this->id,
            'grades'  => $this->grades,
        ];
    }
}