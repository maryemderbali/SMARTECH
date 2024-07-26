<?php

namespace App\Entity;

use App\Repository\TypeProduitRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * TypeProduit
 *
 * @ORM\Table(name="type_produit")
 * @ORM\Entity(repositoryClass=TypeProduitRepository::class)
 */
class TypeProduit
{
    /**
     * @var int
     *
     * @ORM\Column(name="idT", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idt;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_type", type="string", length=50, nullable=false)
     */
    private $nomType;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=50, nullable=false)
     */
    private $description;

    public function getIdt(): ?int
    {
        return $this->idt;
    }

    public function getNomType(): ?string
    {
        return $this->nomType;
    }

    public function setNomType(string $nomType): static
    {
        $this->nomType = $nomType;

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


}
