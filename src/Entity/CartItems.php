<?php

namespace App\Entity;

use App\Repository\CartItemsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * CartItems
 *
 * @ORM\Table(name="cart_items", indexes={@ORM\Index(name="panier_id", columns={"panier_id"}), @ORM\Index(name="id_produit", columns={"id_produit"})})
 * @ORM\Entity(repositoryClass=CartItemsRepository::class)
 */
class CartItems
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="id_produit", type="integer", nullable=false)
     */
    private $idProduit;

    /**
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer", nullable=false)
     */
    private $quantity;

    /**
     * @var \Paniers
     *
     * @ORM\ManyToOne(targetEntity="Paniers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="panier_id", referencedColumnName="panier_id")
     * })
     */
    private $panier;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdProduit(): ?int
    {
        return $this->idProduit;
    }

    public function setIdProduit(int $idProduit): static
    {
        $this->idProduit = $idProduit;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getPanier(): ?Paniers
    {
        return $this->panier;
    }

    public function setPanier(?Paniers $panier): static
    {
        $this->panier = $panier;

        return $this;
    }


}
