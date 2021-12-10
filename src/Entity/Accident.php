<?php

namespace App\Entity;

use App\Repository\AccidentRepository;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

use Symfony\Component\HttpFoundation;



/**
 * @ORM\Entity(repositoryClass=AccidentRepository::class)
 *  @Vich\Uploadable
 */
class Accident
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date_accident;

    /**
     * @ORM\Column(type="integer")
     * * @Assert\Length(
     *      min = 8,
     *      max = 8,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters"
     * )
     */
    private $cin_assureur1;

    /**
     * @ORM\Column(type="string")
     * * @Assert\Length(
     *      min = 8,
     *      max = 8,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters"
     * )
     */
    private $cin_assureur2;

    /**
     * @ORM\Column(type="string", length=255)
     *  * @Assert\NotBlank
     *  * @Assert\Length(
     *      min = 6,
     *      max = 10,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters"
     * )
     *
     */
    private $emplacement;
    /**
     * @ORM\Column(type="string")
     *
     * @var string|null
     */
    private $imageName;

    /**
     * @var File
     * @Vich\UploadableField(mapping="accident_image",fileNameProperty="imageName")
     */
    private $imageFile;

    /**
     * @ORM\ManyToOne(targetEntity=Detailaccident::class, inversedBy="accident")
     */
    private $detailaccident;





    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateAccident(): ?\DateTimeInterface
    {
        return $this->date_accident;
    }

    public function setDateAccident(\DateTimeInterface $date_accident): self
    {
        $this->date_accident = $date_accident;

        return $this;
    }

    public function getCinAssureur1(): ?int
    {
        return $this->cin_assureur1;
    }

    public function setCinAssureur1(int $cin_assureur1): self
    {
        $this->cin_assureur1 = $cin_assureur1;

        return $this;
    }

    public function getCinAssureur2(): ?string
    {
        return $this->cin_assureur2;
    }

    public function setCinAssureur2(string $cin_assureur2): self
    {
        $this->cin_assureur2 = $cin_assureur2;

        return $this;
    }

    public function getEmplacement(): ?string
    {
        return $this->emplacement;
    }

    public function setEmplacement(string $emplacement): self
    {
        $this->emplacement = $emplacement;

        return $this;
    }

    public function getDetailaccident(): ?Detailaccident
    {
        return $this->detailaccident;
    }

    public function setDetailaccident(?Detailaccident $detailaccident): self
    {
        $this->detailaccident = $detailaccident;

        return $this;
    }

    public function setImageFile( $imageFile = null)
    {
        $this->imageFile = $imageFile;
        if (null !== $imageFile) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }
    protected $captchaCode;

    public function getCaptchaCode()
    {
        return $this->captchaCode;
    }

    public function setCaptchaCode($captchaCode)
    {
        $this->captchaCode = $captchaCode;
    }

}
