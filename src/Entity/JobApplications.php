<?php

namespace App\Entity;

use App\Repository\JobApplicationsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity(repositoryClass=JobApplicationsRepository::class)
 */
class JobApplications
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=225)
     */
    private $first_name;

    /**
     * @ORM\Column(type="string", length=225)
     */
    private $last_name;

    /**
     * @ORM\Column(type="string", length=225, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $message;

    /**
     * @ORM\Column(type="string", length=255)
     *
     */
    private $filename;

    /**
     * @ORM\Column(type="boolean", options={"default":"0"})
     *
     */
    private $archived;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getfilename(): ?string
    {
        return $this->filename;
    }

    public function setfilename(?string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }

    public function getarchived()
    {
        return $this->archived;
    }

    public function setarchived($archived): self
    {
        $this->archived = $archived;

        return $this;
    }
}
