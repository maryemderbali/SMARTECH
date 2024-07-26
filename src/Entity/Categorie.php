<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Categorie
 *
 * @ORM\Table(name="categorie")
 * @ORM\Entity(repositoryClass=CategorieRepository::class)
 */
class Categorie
{
    /**
     * @var int
     *
     * @ORM\Column(name="idCategorie", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcategorie;

    /**
     * @var string
     *
     * @ORM\Column(name="nomCategorie", type="string", length=255, nullable=false)
     */
    private $nomcategorie;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionCategorie", type="string", length=255, nullable=false)
     */
    private $descriptioncategorie;

    public function getIdcategorie(): ?int
    {
        return $this->idcategorie;
    }

    public function getNomcategorie(): ?string
    {
        return $this->nomcategorie;
    }

    public function setNomcategorie(string $nomcategorie): static
    {
        $this->nomcategorie = $nomcategorie;

        return $this;
    }

    public function getDescriptioncategorie(): ?string
    {
        return $this->descriptioncategorie;
    }

    public function setDescriptioncategorie(string $descriptioncategorie): static
    {
        $this->descriptioncategorie = $descriptioncategorie;

        return $this;
    }


}
