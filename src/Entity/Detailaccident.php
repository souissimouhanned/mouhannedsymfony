<?php

namespace App\Entity;

use App\Repository\DetailaccidentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=DetailaccidentRepository::class)
 */
class Detailaccident
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * * @Assert\Length(
     *      min = 6,
     *      max = 10,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters"
     * )
     */
    private $matricule;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description_text;

    /**
     * @ORM\OneToMany(targetEntity=Accident::class, mappedBy="detailaccident")
     */
    private $Accident;

    public function __construct()
    {
        $this->Accident = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getDescriptionText(): ?string
    {
        return $this->description_text;
    }

    public function setDescriptionText(string $description_text): self
    {
        $this->description_text = $description_text;

        return $this;
    }

    /**
     * @return Collection|Accident[]
     */
    public function getAccident(): Collection
    {
        return $this->Accident;
    }

    public function addAccident(Accident $accident): self
    {
        if (!$this->Accident->contains($accident)) {
            $this->Accident[] = $accident;
            $accident->setDetailaccident($this);
        }

        return $this;
    }

    public function removeAccident(Accident $accident): self
    {
        if ($this->Accident->removeElement($accident)) {
            // set the owning side to null (unless already changed)
            if ($accident->getDetailaccident() === $this) {
                $accident->setDetailaccident(null);
            }
        }

        return $this;
    }
}
