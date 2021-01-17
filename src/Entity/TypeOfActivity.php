<?php

namespace App\Entity;

use App\Repository\TypeOfActivityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeOfActivityRepository::class)
 */
class TypeOfActivity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\Column(type="boolean")
     */
    private $distance = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private $elevation = false;

    /**
     * @ORM\OneToMany(targetEntity=Activity::class, mappedBy="type", orphanRemoval=true)
     */
    private $activities;

    public function __construct()
    {
        $this->activities = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDistance(): ?bool
    {
        return $this->distance;
    }

    public function setDistance(bool $distance): self
    {
        $this->distance = $distance;

        return $this;
    }

    public function getElevation(): ?bool
    {
        return $this->elevation;
    }

    public function setElevation(bool $elevation): self
    {
        $this->elevation = $elevation;

        return $this;
    }

    /**
     * @return Collection|Activity[]
     */
    public function getActivities(): Collection
    {
        return $this->activities;
    }

    public function addActivity(Activity $activity): self
    {
        if (!$this->activities->contains($activity)) {
            $this->activities[] = $activity;
            $activity->setType($this);
        }

        return $this;
    }

    public function removeActivity(Activity $activity): self
    {
        if ($this->activities->removeElement($activity)) {
            // set the owning side to null (unless already changed)
            if ($activity->getType() === $this) {
                $activity->setType(null);
            }
        }

        return $this;
    }
}
