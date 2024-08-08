<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240808101918 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE peser (id INT AUTO_INCREMENT NOT NULL, boxeur_id INT NOT NULL, categorie_id INT NOT NULL, poids INT NOT NULL, date_poids DATETIME NOT NULL, INDEX IDX_C33E491873ED14B4 (boxeur_id), INDEX IDX_C33E4918BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE peser ADD CONSTRAINT FK_C33E491873ED14B4 FOREIGN KEY (boxeur_id) REFERENCES boxeur (id)');
        $this->addSql('ALTER TABLE peser ADD CONSTRAINT FK_C33E4918BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE peser DROP FOREIGN KEY FK_C33E491873ED14B4');
        $this->addSql('ALTER TABLE peser DROP FOREIGN KEY FK_C33E4918BCF5E72D');
        $this->addSql('DROP TABLE peser');
    }
}
