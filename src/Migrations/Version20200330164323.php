<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200330164323 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE trajet CHANGE autheur_id autheur_id INT DEFAULT NULL, CHANGE date_expiration date_expiration DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE avis CHANGE avis_trajet_id avis_trajet_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955B67818E0');
        $this->addSql('DROP INDEX IDX_42C84955B67818E0 ON reservation');
        $this->addSql('ALTER TABLE reservation ADD passager_id INT DEFAULT NULL, DROP reserve_trajet_id');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495571A51189 FOREIGN KEY (passager_id) REFERENCES Trajet (id)');
        $this->addSql('CREATE INDEX IDX_42C8495571A51189 ON reservation (passager_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE avis CHANGE avis_trajet_id avis_trajet_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495571A51189');
        $this->addSql('DROP INDEX IDX_42C8495571A51189 ON reservation');
        $this->addSql('ALTER TABLE reservation ADD reserve_trajet_id INT DEFAULT NULL, DROP passager_id');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955B67818E0 FOREIGN KEY (reserve_trajet_id) REFERENCES trajet (id)');
        $this->addSql('CREATE INDEX IDX_42C84955B67818E0 ON reservation (reserve_trajet_id)');
        $this->addSql('ALTER TABLE Trajet CHANGE autheur_id autheur_id INT DEFAULT NULL, CHANGE date_expiration date_expiration DATE DEFAULT \'NULL\'');
    }
}
