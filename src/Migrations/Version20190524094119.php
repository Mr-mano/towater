<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190524094119 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE aime (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, article_id INT DEFAULT NULL, INDEX IDX_8533FE8FB88E14F (utilisateur_id), INDEX IDX_8533FE87294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE album (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, titre VARCHAR(255) NOT NULL, INDEX IDX_39986E43FB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, album_id INT DEFAULT NULL, utilisateur_id INT NOT NULL, libelle VARCHAR(255) NOT NULL, texte LONGTEXT NOT NULL, photo VARCHAR(255) DEFAULT NULL, lien_youtube VARCHAR(255) DEFAULT NULL, date_creation DATETIME NOT NULL, no_kill TINYINT(1) NOT NULL, INDEX IDX_23A0E661137ABCF (album_id), INDEX IDX_23A0E66FB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, article_id INT DEFAULT NULL, texte LONGTEXT NOT NULL, date_creation DATETIME DEFAULT NULL, INDEX IDX_67F068BCFB88E14F (utilisateur_id), INDEX IDX_67F068BC7294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evenement (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, evenement_categorie_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, texte LONGTEXT NOT NULL, date_evenement DATE NOT NULL, photo VARCHAR(255) DEFAULT NULL, INDEX IDX_B26681EFB88E14F (utilisateur_id), INDEX IDX_B26681E10D88B7B (evenement_categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evenement_categorie (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, categorie_id INT NOT NULL, libelle VARCHAR(255) NOT NULL, date_creation DATETIME NOT NULL, date_maj DATETIME DEFAULT NULL, date_vente DATETIME DEFAULT NULL, photo VARCHAR(255) NOT NULL, prix NUMERIC(10, 2) NOT NULL, mise_en_avant TINYINT(1) NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_29A5EC27FB88E14F (utilisateur_id), INDEX IDX_29A5EC27BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit_categorie (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE suivre (id INT AUTO_INCREMENT NOT NULL, utilisateur_from_id INT DEFAULT NULL, utilisateur_to_id INT DEFAULT NULL, INDEX IDX_3BC593BB2C52E99 (utilisateur_from_id), INDEX IDX_3BC593BBF6F012BB (utilisateur_to_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telephone VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) NOT NULL, commune VARCHAR(255) NOT NULL, code_postal VARCHAR(255) NOT NULL, departement VARCHAR(255) NOT NULL, site_web VARCHAR(255) DEFAULT NULL, nom_entreprise VARCHAR(255) DEFAULT NULL, siret VARCHAR(255) DEFAULT NULL, nom_association VARCHAR(255) DEFAULT NULL, nom_president VARCHAR(255) DEFAULT NULL, prenom_president VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, roles JSON NOT NULL, photo VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE aime ADD CONSTRAINT FK_8533FE8FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE aime ADD CONSTRAINT FK_8533FE87294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE album ADD CONSTRAINT FK_39986E43FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E661137ABCF FOREIGN KEY (album_id) REFERENCES album (id)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC7294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681EFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681E10D88B7B FOREIGN KEY (evenement_categorie_id) REFERENCES evenement (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27BCF5E72D FOREIGN KEY (categorie_id) REFERENCES produit_categorie (id)');
        $this->addSql('ALTER TABLE suivre ADD CONSTRAINT FK_3BC593BB2C52E99 FOREIGN KEY (utilisateur_from_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE suivre ADD CONSTRAINT FK_3BC593BBF6F012BB FOREIGN KEY (utilisateur_to_id) REFERENCES utilisateur (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E661137ABCF');
        $this->addSql('ALTER TABLE aime DROP FOREIGN KEY FK_8533FE87294869C');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC7294869C');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681E10D88B7B');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27BCF5E72D');
        $this->addSql('ALTER TABLE aime DROP FOREIGN KEY FK_8533FE8FB88E14F');
        $this->addSql('ALTER TABLE album DROP FOREIGN KEY FK_39986E43FB88E14F');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66FB88E14F');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCFB88E14F');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681EFB88E14F');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27FB88E14F');
        $this->addSql('ALTER TABLE suivre DROP FOREIGN KEY FK_3BC593BB2C52E99');
        $this->addSql('ALTER TABLE suivre DROP FOREIGN KEY FK_3BC593BBF6F012BB');
        $this->addSql('DROP TABLE aime');
        $this->addSql('DROP TABLE album');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('DROP TABLE evenement_categorie');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE produit_categorie');
        $this->addSql('DROP TABLE suivre');
        $this->addSql('DROP TABLE utilisateur');
    }
}
