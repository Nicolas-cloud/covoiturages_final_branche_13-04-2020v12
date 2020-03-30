<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200329171331 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE avis (id INT AUTO_INCREMENT NOT NULL, avis_trajet_id INT DEFAULT NULL, commentaire VARCHAR(255) NOT NULL, date_publication DATE NOT NULL, INDEX IDX_8F91ABF0AB47B7E2 (avis_trajet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, reserve_trajet_id INT DEFAULT NULL, date_reservation DATE NOT NULL, validation TINYINT(1) NOT NULL, annulation TINYINT(1) NOT NULL, INDEX IDX_42C84955B67818E0 (reserve_trajet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Trajet (id INT AUTO_INCREMENT NOT NULL, autheur_id INT DEFAULT NULL, ville_depart VARCHAR(255) NOT NULL, ville_arrivee VARCHAR(255) NOT NULL, heure_depart DATETIME NOT NULL, heure_arrivee DATETIME NOT NULL, prix DOUBLE PRECISION NOT NULL, nb_places INT NOT NULL, description VARCHAR(255) NOT NULL, date_creation DATE NOT NULL, date_modification DATE NOT NULL, date_expiration DATE DEFAULT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_2CF7ACBAC6E59929 (autheur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, pseudo VARCHAR(255) NOT NULL, sexe VARCHAR(255) NOT NULL, annee_naissance DATE NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0AB47B7E2 FOREIGN KEY (avis_trajet_id) REFERENCES Trajet (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955B67818E0 FOREIGN KEY (reserve_trajet_id) REFERENCES Trajet (id)');
        $this->addSql('ALTER TABLE Trajet ADD CONSTRAINT FK_2CF7ACBAC6E59929 FOREIGN KEY (autheur_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0AB47B7E2');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955B67818E0');
        $this->addSql('ALTER TABLE Trajet DROP FOREIGN KEY FK_2CF7ACBAC6E59929');
        $this->addSql('DROP TABLE avis');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE Trajet');
        $this->addSql('DROP TABLE user');
    }
}
