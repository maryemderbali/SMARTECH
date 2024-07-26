<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231115194750 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cart_items (id INT AUTO_INCREMENT NOT NULL, panier_id INT DEFAULT NULL, id_produit INT NOT NULL, quantity INT NOT NULL, INDEX panier_id (panier_id), INDEX id_produit (id_produit), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (idCategorie INT AUTO_INCREMENT NOT NULL, nomCategorie VARCHAR(255) NOT NULL, descriptionCategorie VARCHAR(255) NOT NULL, PRIMARY KEY(idCategorie)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (IdCategorie INT AUTO_INCREMENT NOT NULL, NomCategorie VARCHAR(50) NOT NULL, DescriptionCategorie VARCHAR(200) NOT NULL, PRIMARY KEY(IdCategorie)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commandee (id INT AUTO_INCREMENT NOT NULL, id_user INT DEFAULT NULL, service VARCHAR(255) NOT NULL, Date DATE NOT NULL, INDEX commandee_ibfk_1 (id_user), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enchere (Titre VARCHAR(255) NOT NULL, Id VARCHAR(255) NOT NULL, Description VARCHAR(255) NOT NULL, dateDebut DATE NOT NULL, dateFin DATE NOT NULL, offre_initial VARCHAR(255) NOT NULL, UNIQUE INDEX ID (Id), PRIMARY KEY(Titre)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE facture (idFacture INT AUTO_INCREMENT NOT NULL, Montant DOUBLE PRECISION NOT NULL, Date DATE NOT NULL, idCommande INT DEFAULT NULL, INDEX idCommande (idCommande), PRIMARY KEY(idFacture)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job (Id INT AUTO_INCREMENT NOT NULL, Type VARCHAR(100) NOT NULL, MetierOuProduit VARCHAR(100) NOT NULL, Description VARCHAR(100) NOT NULL, Photos VARCHAR(100) NOT NULL, NomCategorie VARCHAR(100) NOT NULL, PRIMARY KEY(Id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livraison (nom VARCHAR(500) NOT NULL, prenom VARCHAR(500) NOT NULL, adresse VARCHAR(500) NOT NULL, prix INT NOT NULL, nbre_commandes INT NOT NULL, idLivraison INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(idLivraison)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE paniers (panier_id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, INDEX utilisateur_id (utilisateur_id), PRIMARY KEY(panier_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produits (idP INT AUTO_INCREMENT NOT NULL, prix VARCHAR(60) NOT NULL, description VARCHAR(50) NOT NULL, image VARCHAR(30) DEFAULT \'NULL\', nom_produit VARCHAR(50) NOT NULL, nombre_produits INT NOT NULL, idT INT DEFAULT NULL, INDEX produits_ibfk_1 (idT), PRIMARY KEY(idP)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE proposition (Nom_prestataire VARCHAR(255) NOT NULL, ID_Entreprise VARCHAR(255) NOT NULL, numero_telephone VARCHAR(8) NOT NULL, Mail VARCHAR(255) DEFAULT \'\'\'nom@localhost.lan\'\'\' NOT NULL, Titre VARCHAR(255) NOT NULL, Montant DOUBLE PRECISION NOT NULL, Message TEXT NOT NULL, UNIQUE INDEX ID_Entreprise (ID_Entreprise), PRIMARY KEY(Nom_prestataire)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (IdService INT AUTO_INCREMENT NOT NULL, nomService VARCHAR(1000) NOT NULL, dateCreation DATE NOT NULL, location VARCHAR(1000) NOT NULL, prix INT NOT NULL, timeAvailable DATE NOT NULL, fk_idCategorie INT DEFAULT NULL, INDEX fk_idCategorie (fk_idCategorie), PRIMARY KEY(IdService)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_produit (idT INT AUTO_INCREMENT NOT NULL, nom_type VARCHAR(50) NOT NULL, description VARCHAR(50) NOT NULL, PRIMARY KEY(idT)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateurs (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(256) NOT NULL, prenom VARCHAR(256) NOT NULL, mdp VARCHAR(254) DEFAULT \'NULL\', email VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, salt VARCHAR(256) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cart_items ADD CONSTRAINT FK_BEF48445F77D927C FOREIGN KEY (panier_id) REFERENCES paniers (panier_id)');
        $this->addSql('ALTER TABLE commandee ADD CONSTRAINT FK_C1009D7D6B3CA4B FOREIGN KEY (id_user) REFERENCES utilisateurs (id)');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE8664103D498C26 FOREIGN KEY (idCommande) REFERENCES commandee (id)');
        $this->addSql('ALTER TABLE paniers ADD CONSTRAINT FK_48999036FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs (id)');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT FK_BE2DDF8CD5D012F3 FOREIGN KEY (idT) REFERENCES type_produit (idT)');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD2DC615156 FOREIGN KEY (fk_idCategorie) REFERENCES categorie (idCategorie)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart_items DROP FOREIGN KEY FK_BEF48445F77D927C');
        $this->addSql('ALTER TABLE commandee DROP FOREIGN KEY FK_C1009D7D6B3CA4B');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE8664103D498C26');
        $this->addSql('ALTER TABLE paniers DROP FOREIGN KEY FK_48999036FB88E14F');
        $this->addSql('ALTER TABLE produits DROP FOREIGN KEY FK_BE2DDF8CD5D012F3');
        $this->addSql('ALTER TABLE service DROP FOREIGN KEY FK_E19D9AD2DC615156');
        $this->addSql('DROP TABLE cart_items');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE commandee');
        $this->addSql('DROP TABLE enchere');
        $this->addSql('DROP TABLE facture');
        $this->addSql('DROP TABLE job');
        $this->addSql('DROP TABLE livraison');
        $this->addSql('DROP TABLE paniers');
        $this->addSql('DROP TABLE produits');
        $this->addSql('DROP TABLE proposition');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE type_produit');
        $this->addSql('DROP TABLE utilisateurs');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
