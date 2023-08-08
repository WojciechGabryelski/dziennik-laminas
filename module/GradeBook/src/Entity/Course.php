<?php

namespace GradeBook\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use GradeBook\Entity\Repository\CourseRepository;

/**
 * @ORM\Entity(repositoryClass="CourseRepository")
 * @ORM\Table(name="courses")
 */
#[ORM\Entity(repositoryClass: CourseRepository::class)]
#[ORM\Table(name: 'courses')]
class Course
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
     * @var string
     * @ORM\Column(type="string")
     */
    #[ORM\Column(type: 'string')]
    private string $name;
    /**
     * @var Teacher
     * @ORM\ManyToOne(targetEntity="Teacher", inversedBy="courses")
     */
    #[ORM\ManyToOne(targetEntity: Teacher::class, inversedBy: 'courses')]
    private Teacher $teacher;
    /**
     * @var Collection
     * @ORM\OneToMany(mappedBy="course", targetEntity="StudentCourse")
     */
    #[ORM\OneToMany(mappedBy: 'course', targetEntity: StudentCourse::class)]
    private Collection $studentsCourse;

    public function __construct()
    {
        $this->studentsCourse = new ArrayCollection();
    }

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
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return Teacher
     */
    public function getTeacher(): Teacher
    {
        return $this->teacher;
    }

    /**
     * @param Teacher $teacher
     */
    public function setTeacher(Teacher $teacher): void
    {
        $this->teacher = $teacher;
    }

    /**
     * @return Collection
     */
    public function getStudentsCourse(): Collection
    {
        return $this->studentsCourse;
    }

    /**
     * @param StudentCourse $studentCourse
     */
    public function addStudentsCourse(StudentCourse $studentCourse): void
    {
        $this->studentsCourse[] = $studentCourse;
    }

    public function exchangeArray(array $data): void
    {
        if (!empty($data['id'])) {
            $this->id = $data['id'];
        }
        if (!empty($data['name'])) {
            $this->name = $data['name'];
        }
        if (!empty($data['teacher'])  && gettype($data['teacher']) != 'integer') {
            $this->teacher = $data['teacher'];
        }
    }

    public function getArrayCopy(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'teacher' => $this->teacher->getId(),
        ];
    }
}