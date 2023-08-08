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
#[ORM\Table(name: 'students')]
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
     * @ORM\Column(name="first_name", type="string")
     */
    #[ORM\Column(name: 'first_name', type: 'string')]
    private string $firstName;
    /**
     * @var string
     * @ORM\Column(name="last_name", type="string")
     */
    #[ORM\Column(name: 'last_name', type: 'string')]
    private string $lastName;
    /**
     * @var Collection
     * @ORM\OneToMany(mappedBy="students", targetEntity="StudentCourse")
     */
    #[ORM\OneToMany(mappedBy: 'students', targetEntity: StudentCourse::class)]
    private Collection $studentCourses;

    public function __construct()
    {
        $this->studentCourses = new ArrayCollection();
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
    public function getStudentCourses(): Collection
    {
        return $this->studentCourses;
    }

    /**
     * @param StudentCourse $studentCourse
     */
    public function addStudentCourse(StudentCourse $studentCourse): void
    {
        $this->studentCourses[] = $studentCourse;
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
    }

    public function getArrayCopy(): array
    {
        return [
            'firstName' => $this->firstName,
            'lastName'  => $this->lastName,
            'id'        => $this->id,
        ];
    }
}