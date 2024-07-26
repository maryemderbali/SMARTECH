<?php

namespace App\Entity;

use App\Repository\PropositionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Proposition
 *
 * @ORM\Table(name="proposition", uniqueConstraints={@ORM\UniqueConstraint(name="ID_Entreprise", columns={"ID_Entreprise"})})
 * @ORM\Entity(repositoryClass=PropositionRepository::class)
 */
class Proposition
{
    /**
     * @var string
     *
     * @ORM\Column(name="Nom_prestataire", type="string", length=255, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $nomPrestataire;

    /**
     * @var string
     *
     * @ORM\Column(name="ID_Entreprise", type="string", length=255, nullable=false)
     */
    private $idEntreprise;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_telephone", type="string", length=8, nullable=false)
     */
    private $numeroTelephone;

    /**
     * @var string
     *
     * @ORM\Column(name="Mail", type="string", length=255, nullable=false, options={"default"="'nom@localhost.lan'"})
     */
    private $mail = '\'nom@localhost.lan\'';

    /**
     * @var string
     *
     * @ORM\Column(name="Titre", type="string", length=255, nullable=false)
     */
    private $titre;

    /**
     * @var float
     *
     * @ORM\Column(name="Montant", type="float", precision=10, scale=0, nullable=false)
     */
    private $montant;

    /**
     * @var string
     *
     * @ORM\Column(name="Message", type="text", length=65535, nullable=false)
     */
    private $message;

    public function getNomPrestataire(): ?string
    {
        return $this->nomPrestataire;
    }

    public function getIdEntreprise(): ?string
    {
        return $this->idEntreprise;
    }

    public function setIdEntreprise(string $idEntreprise): static
    {
        $this->idEntreprise = $idEntreprise;

        return $this;
    }

    public function getNumeroTelephone(): ?string
    {
        return $this->numeroTelephone;
    }

    public function setNumeroTelephone(string $numeroTelephone): static
    {
        $this->numeroTelephone = $numeroTelephone;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): static
    {
        $this->mail = $mail;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): static
    {
        $this->montant = $montant;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): static
    {
        $this->message = $message;

        return $this;
    }


}
