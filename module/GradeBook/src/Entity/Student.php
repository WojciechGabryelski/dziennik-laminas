<?php

namespace GradeBook\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use GradeBook\Entity\Repository\StudentRepository;

/**
 * @ORM\Entity(repositoryClass="StudentRepository")
 * @ORM\Table(name="students")
 */
#[ORM\Entity(repositoryClass: StudentRepository::class)]
class Student
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
    private string $firstName;
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    #[ORM\Column(type: 'string')]
    private string $lastName;
    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="Grade", mappedBy="student")
     */
    #[ORM\OneToMany(mappedBy: 'student', targetEntity: Grade::class)]
    private Collection $grades;
    /**
     * @var Collection
     * @ORM\ManyToMany(targetEntity="Course")
     */
    #[ORM\ManyToMany(targetEntity: Course::class)]
    private Collection $courses;

    public function __construct()
    {
        $this->grades = new ArrayCollection();
        $this->courses = new ArrayCollection();
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
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
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

    /**
     * @return Collection
     */
    public function getCourses(): Collection
    {
        return $this->courses;
    }

    /**
     * @param Course $course
     */
    public function addCourse(Course $course): void
    {
        $this->courses->add($course);
    }

    public function exchangeArray(array $data): void
    {
        if (!empty($data['firstName'])) {
            $this->firstName = $data['firstName'];
        }
        if (!empty($data['lastName'])) {
            $this->lastName = $data['lastName'];
        }
        if (!empty($data['id'])) {
            $this->id = $data['id'];
        }
        if (!empty($data['courses'])) {
            $this->courses = $data['courses'];
        }
        if (!empty($data['grades'])) {
            $this->grades = $data['grades'];
        }
    }

    public function getArrayCopy(): array
    {
        return [
            'firstName' => $this->firstName,
            'lastName'  => $this->lastName,
            'id'        => $this->id,
            'courses'   => $this->courses,
            'grades'    => $this->grades,
        ];
    }
}