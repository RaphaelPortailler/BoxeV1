<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240808085953 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pratique (id INT AUTO_INCREMENT NOT NULL, boxeur_id INT NOT NULL, type_boxe_id INT NOT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME DEFAULT NULL, INDEX IDX_1F2B78173ED14B4 (boxeur_id), INDEX IDX_1F2B781C9CE0D5 (type_boxe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pratique ADD CONSTRAINT FK_1F2B78173ED14B4 FOREIGN KEY (boxeur_id) REFERENCES boxeur (id)');
        $this->addSql('ALTER TABLE pratique ADD CONSTRAINT FK_1F2B781C9CE0D5 FOREIGN KEY (type_boxe_id) REFERENCES type_boxe (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pratique DROP FOREIGN KEY FK_1F2B78173ED14B4');
        $this->addSql('ALTER TABLE pratique DROP FOREIGN KEY FK_1F2B781C9CE0D5');
        $this->addSql('DROP TABLE pratique');
    }
}
