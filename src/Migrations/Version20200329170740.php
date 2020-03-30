<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200329170740 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE trajet ADD autheur_id INT DEFAULT NULL, CHANGE date_expiration date_expiration DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE trajet ADD CONSTRAINT FK_2CF7ACBAC6E59929 FOREIGN KEY (autheur_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_2CF7ACBAC6E59929 ON trajet (autheur_id)');
        $this->addSql('ALTER TABLE avis CHANGE avis_trajet_id avis_trajet_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation CHANGE reserve_trajet_id reserve_trajet_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE avis CHANGE avis_trajet_id avis_trajet_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation CHANGE reserve_trajet_id reserve_trajet_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE Trajet DROP FOREIGN KEY FK_2CF7ACBAC6E59929');
        $this->addSql('DROP INDEX IDX_2CF7ACBAC6E59929 ON Trajet');
        $this->addSql('ALTER TABLE Trajet DROP autheur_id, CHANGE date_expiration date_expiration DATE DEFAULT \'NULL\'');
    }
}
