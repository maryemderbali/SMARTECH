<?php

namespace App\Entity;

use App\Repository\ServiceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Service
 *
 * @ORM\Table(name="service", indexes={@ORM\Index(name="fk_idCategorie", columns={"fk_idCategorie"})})
 * @ORM\Entity(repositoryClass=ServiceRepository::class)
 */
class Service
{
    /**
     * @var int
     *
     * @ORM\Column(name="IdService", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idservice;

    /**
     * @var string
     *
     * @ORM\Column(name="nomService", type="string", length=1000, nullable=false)
     */
    private $nomservice;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="date", nullable=false)
     */
    private $datecreation;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=1000, nullable=false)
     */
    private $location;

    /**
     * @var int
     *
     * @ORM\Column(name="prix", type="integer", nullable=false)
     */
    private $prix;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timeAvailable", type="date", nullable=false)
     */
    private $timeavailable;

    /**
     * @var \Categorie
     *
     * @ORM\ManyToOne(targetEntity="Categorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_idCategorie", referencedColumnName="idCategorie")
     * })
     */
    private $fkIdcategorie;

    public function getIdservice(): ?int
    {
        return $this->idservice;
    }

    public function getNomservice(): ?string
    {
        return $this->nomservice;
    }

    public function setNomservice(string $nomservice): static
    {
        $this->nomservice = $nomservice;

        return $this;
    }

    public function getDatecreation(): ?\DateTimeInterface
    {
        return $this->datecreation;
    }

    public function setDatecreation(\DateTimeInterface $datecreation): static
    {
        $this->datecreation = $datecreation;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getTimeavailable(): ?\DateTimeInterface
    {
        return $this->timeavailable;
    }

    public function setTimeavailable(\DateTimeInterface $timeavailable): static
    {
        $this->timeavailable = $timeavailable;

        return $this;
    }

    public function getFkIdcategorie(): ?Categorie
    {
        return $this->fkIdcategorie;
    }

    public function setFkIdcategorie(?Categorie $fkIdcategorie): static
    {
        $this->fkIdcategorie = $fkIdcategorie;

        return $this;
    }


}
