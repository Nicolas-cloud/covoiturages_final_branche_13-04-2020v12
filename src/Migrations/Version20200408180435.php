<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200408180435 extends AbstractMigration
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
        $this->addSql('ALTER TABLE reservation ADD nb_places INT NOT NULL, CHANGE passager_id passager_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE trajet CHANGE autheur_id autheur_id INT DEFAULT NULL, CHANGE date_expiration date_expiration DATE DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE avis CHANGE avis_trajet_id avis_trajet_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation DROP nb_places, CHANGE passager_id passager_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE Trajet CHANGE autheur_id autheur_id INT DEFAULT NULL, CHANGE date_expiration date_expiration DATE DEFAULT \'NULL\'');
    }
}
