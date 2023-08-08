<?php

namespace GradeBook\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use GradeBook\Entity\Repository\TeacherRepository;

/**
 * @ORM\Entity(repositoryClass="TeacherRepository")
 * @ORM\Table(name="teachers")
 */
#[ORM\Entity(repositoryClass: TeacherRepository::class)]
#[ORM\Table(name: 'teachers')]
class Teacher
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
     * @ORM\OneToMany(targetEntity="Course", mappedBy="teacher")
     */
    #[ORM\OneToMany(mappedBy: 'teacher', targetEntity: Course::class)]
    private Collection $courses;

    public function __construct()
    {
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
    public function getCourses(): Collection
    {
        return $this->courses;
    }

    /**
     * @param Course $course
     */
    public function addCourse(Course $course): void
    {
        $this->courses[] = $course;
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
    }

    public function getArrayCopy(): array
    {
        return [
            'firstName' => $this->firstName,
            'lastName'  => $this->lastName,
            'id'        => $this->id,
            'courses'   => $this->courses,
        ];
    }
}