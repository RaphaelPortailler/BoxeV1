<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240808100815 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE obtenir (id INT AUTO_INCREMENT NOT NULL, boxeur_id INT NOT NULL, ceinture_id INT NOT NULL, date_obtention DATETIME NOT NULL, date_perte DATETIME DEFAULT NULL, INDEX IDX_ED792AC973ED14B4 (boxeur_id), INDEX IDX_ED792AC9F5FCCB61 (ceinture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE obtenir ADD CONSTRAINT FK_ED792AC973ED14B4 FOREIGN KEY (boxeur_id) REFERENCES boxeur (id)');
        $this->addSql('ALTER TABLE obtenir ADD CONSTRAINT FK_ED792AC9F5FCCB61 FOREIGN KEY (ceinture_id) REFERENCES ceinture (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE obtenir DROP FOREIGN KEY FK_ED792AC973ED14B4');
        $this->addSql('ALTER TABLE obtenir DROP FOREIGN KEY FK_ED792AC9F5FCCB61');
        $this->addSql('DROP TABLE obtenir');
    }
}
