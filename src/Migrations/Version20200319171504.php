<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200319171504 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE avis CHANGE avis_trajet_id avis_trajet_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation CHANGE reserve_trajet_id reserve_trajet_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE trajet CHANGE date_expiration date_expiration DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD nom VARCHAR(255) NOT NULL, ADD prenom VARCHAR(255) NOT NULL, ADD pseudo VARCHAR(255) NOT NULL, ADD sexe VARCHAR(255) NOT NULL, ADD annee_naissance DATE NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE avis CHANGE avis_trajet_id avis_trajet_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation CHANGE reserve_trajet_id reserve_trajet_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE Trajet CHANGE date_expiration date_expiration DATE DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE user DROP nom, DROP prenom, DROP pseudo, DROP sexe, DROP annee_naissance');
    }
}
