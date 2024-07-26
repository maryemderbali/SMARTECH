<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @var int
     *
     * @ORM\Column(name="IdCategorie", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcategorie;

    /**
     * @var string
     *
     * @ORM\Column(name="NomCategorie", type="string", length=50, nullable=false)
     */
    private $nomcategorie;

    /**
     * @var string
     *
     * @ORM\Column(name="DescriptionCategorie", type="string", length=200, nullable=false)
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
