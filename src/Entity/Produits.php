<?php

namespace App\Entity;

use App\Repository\ProduitsRepository;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produits
 *
 * @ORM\Table(name="produits", indexes={@ORM\Index(name="produits_ibfk_1", columns={"idT"})})
 * @ORM\Entity(repositoryClass=ProduitsRepository::class)(repositoryClass=ProduitsRepository::class)
 */
class Produits
{
    /**
     * @var int
     *
     * @ORM\Column(name="idP", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idp;

    /**
     * @var string
     *
     * @ORM\Column(name="prix", type="string", length=60, nullable=false)
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=50, nullable=false)
     */
    private $description;

    /**
     * @var string|null
     *
     * @ORM\Column(name="image", type="string", length=30, nullable=true, options={"default"="NULL"})
     */
    private $image = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="nom_produit", type="string", length=50, nullable=false)
     */
    private $nomProduit;

    /**
     * @var int
     *
     * @ORM\Column(name="nombre_produits", type="integer", nullable=false)
     */
    private $nombreProduits;

    /**
     * @var \TypeProduit
     *
     * @ORM\ManyToOne(targetEntity="TypeProduit")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idT", referencedColumnName="idT")
     * })
     */
    private $idt;

    public function getIdp(): ?int
    {
        return $this->idp;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getNomProduit(): ?string
    {
        return $this->nomProduit;
    }

    public function setNomProduit(string $nomProduit): static
    {
        $this->nomProduit = $nomProduit;

        return $this;
    }

    public function getNombreProduits(): ?int
    {
        return $this->nombreProduits;
    }

    public function setNombreProduits(int $nombreProduits): static
    {
        $this->nombreProduits = $nombreProduits;

        return $this;
    }

    public function getIdt(): ?TypeProduit
    {
        return $this->idt;
    }

    public function setIdt(?TypeProduit $idt): static
    {
        $this->idt = $idt;

        return $this;
    }


}
