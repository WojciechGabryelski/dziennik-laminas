<?php

namespace GradeBook\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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
     * @var Student
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Student", inversedBy="studentCourses")
     */
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Student::class, inversedBy: 'studentCourses')]
    private Student $student;
    /**
     * @var Course
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Course", inversedBy="studentsCourse")
     */
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Course::class, inversedBy: 'studentsCourse')]
    private Course $course;
    /**
     * @var Collection
     * @ORM\OneToMany(mappedBy="studentCourse", targetEntity="Grade")
     */
    #[ORM\OneToMany(mappedBy: 'studentCourse', targetEntity: Grade::class)]
    private Collection $grades;

    public function __construct()
    {
        $this->grades = new ArrayCollection();
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
    public function addGrade(Grade $grade): void
    {
        $this->grades[] = $grade;
    }

    public function exchangeArray(array $data): void
    {
        if (!empty($data['student']) && gettype($data['student']) != 'integer') {
            $this->student = $data['student'];
        }
        if (!empty($data['course']) && gettype($data['course']) != 'integer') {
            $this->course = $data['course'];
        }
        if (!empty($data['grades'])) {
            $this->grades = $data['grades'];
        }
    }

    public function getArrayCopy(): array
    {
        return [
            'student' => $this->student->getId(),
            'course'  => $this->course->getId(),
            'grades'  => $this->grades,
        ];
    }
}