<?php

namespace GradeBook\Entity;

use Doctrine\ORM\Mapping as ORM;
use GradeBook\Entity\Repository\AdminRepository;

/**
 * @ORM\Entity(repositoryClass="AdminRepository")
 * @ORM\Table(name="admins")
 */
#[ORM\Entity(repositoryClass: AdminRepository::class)]
#[ORM\Table(name: 'admins')]
class Admin
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