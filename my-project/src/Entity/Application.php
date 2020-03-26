<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ApplicationRepository")
 */
class Application
{
    public const STATUS_IN_QUEUED = 0;
    public const STATUS_ACCEPTED = 1;
    public const STATUS_DECLINED = 2;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $uid;

    /**
     * @Assert\NotBlank
     *
     * @ORM\Column(type="string", length=255)
     */
    private $companyName;

    /**
     * @Assert\NotBlank
     *
     * @ORM\Column(type="string", length=255)
     */
    private $companyIin;

    /**
     * @Assert\NotBlank
     *
     * @ORM\Column(type="string", length=255)
     */
    private $directorFullName;

    /**
     * @Assert\NotBlank
     *
     * @ORM\Column(type="string", length=255)
     */
    private $phoneNumber;

    /**
     * @Assert\NotBlank
     *
     * @ORM\Column(type="text", length=255)
     */
    private $movementArea;

    /**
     * @Assert\NotBlank
     * @Assert\Email
     *
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="integer", length=255)
     */
    private $status = self::STATUS_IN_QUEUED;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $externalId;

    /**
     * @ORM\Column(type="text", length=255, nullable=true)
     */
    private $declinedReason;

    /**
     * @ORM\Column(type="text", length=255, nullable=true)
     */
    private $officerFullName;

    /**
     * @ORM\Column(type="text", length=255, nullable=true)
     */
    private $reviewedBy;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $reviewedAt;

    /**
     * @ORM\Column(type="date")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $updatedAt;

    /**
     * @Assert\Valid()
     * @Assert\Count(min=1)
     *
     * @ORM\OneToMany(targetEntity="App\Entity\ApplicationCar", mappedBy="application", cascade={"persist"}))
     */
    private $cars;

    public function __construct()
    {
        $this->cars = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUid(): ?string
    {
        return $this->uid;
    }

    public function setUid(string $uid): self
    {
        $this->uid = $uid;

        return $this;
    }

    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    public function setCompanyName(string $companyName): self
    {
        $this->companyName = $companyName;

        return $this;
    }

    public function getCompanyIin(): ?string
    {
        return $this->companyIin;
    }

    public function setCompanyIin(string $companyIin): self
    {
        $this->companyIin = $companyIin;

        return $this;
    }

    public function getDirectorFullName(): ?string
    {
        return $this->directorFullName;
    }

    public function setDirectorFullName(string $directorFullName): self
    {
        $this->directorFullName = $directorFullName;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getMovementArea(): ?string
    {
        return $this->movementArea;
    }

    public function setMovementArea(string $movementArea): self
    {
        $this->movementArea = $movementArea;

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

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getExternalId(): ?string
    {
        return $this->externalId;
    }

    public function setExternalId(?string $externalId): self
    {
        $this->externalId = $externalId;

        return $this;
    }

    public function getDeclinedReason(): ?string
    {
        return $this->declinedReason;
    }

    public function setDeclinedReason(?string $declinedReason): self
    {
        $this->declinedReason = $declinedReason;

        return $this;
    }

    public function getOfficerFullName(): ?string
    {
        return $this->officerFullName;
    }

    public function setOfficerFullName(?string $officerFullName): self
    {
        $this->officerFullName = $officerFullName;

        return $this;
    }

    public function getReviewedAt(): ?\DateTimeInterface
    {
        return $this->reviewedAt;
    }

    public function setReviewedAt(?\DateTimeInterface $reviewedAt): self
    {
        $this->reviewedAt = $reviewedAt;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection|ApplicationCar[]
     */
    public function getCars(): Collection
    {
        return $this->cars;
    }

    public function addCar(ApplicationCar $car): self
    {
        if (!$this->cars->contains($car)) {
            $this->cars[] = $car;
            $car->setApplication($this);
        }

        return $this;
    }

    public function removeCar(ApplicationCar $car): self
    {
        if ($this->cars->contains($car)) {
            $this->cars->removeElement($car);
            // set the owning side to null (unless already changed)
            if ($car->getApplication() === $this) {
                $car->setApplication(null);
            }
        }

        return $this;
    }

    public function getReviewedBy(): ?string
    {
        return $this->reviewedBy;
    }

    public function setReviewedBy(?string $reviewedBy): self
    {
        $this->reviewedBy = $reviewedBy;

        return $this;
    }

}
