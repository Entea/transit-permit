<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ApplicationCarRepository")
 */
class ApplicationCar
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @@Assert\NotBlank
     *
     * @ORM\Column(type="string", length=255)
     */
    private $driverFullName = '';

    /**
     * @Assert\NotBlank
     *
     * @ORM\Column(type="string", length=255)
     */
    private $carIdentifier;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Application", inversedBy="cars")
     */
    private $application;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDriverFullName(): ?string
    {
        return $this->driverFullName;
    }

    public function setDriverFullName(string $driverFullName): self
    {
        $this->driverFullName = $driverFullName;

        return $this;
    }

    public function getApplication(): ?Application
    {
        return $this->application;
    }

    public function setApplication(?Application $application): self
    {
        $this->application = $application;

        return $this;
    }

    public function getCarIdentifier(): ?string
    {
        return $this->carIdentifier;
    }

    public function setCarIdentifier(string $carIdentifier): self
    {
        $this->carIdentifier = $carIdentifier;

        return $this;
    }
}
