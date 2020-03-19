<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200317215630 extends AbstractMigration
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
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE avis CHANGE avis_trajet_id avis_trajet_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation CHANGE reserve_trajet_id reserve_trajet_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE Trajet CHANGE date_expiration date_expiration DATE DEFAULT \'NULL\'');
    }
}
