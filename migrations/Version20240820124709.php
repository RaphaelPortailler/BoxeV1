<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240820124709 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F73ED14B4');
        $this->addSql('DROP INDEX IDX_C53D045F73ED14B4 ON image');
        $this->addSql('ALTER TABLE image DROP boxeur_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image ADD boxeur_id INT NOT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F73ED14B4 FOREIGN KEY (boxeur_id) REFERENCES boxeur (id)');
        $this->addSql('CREATE INDEX IDX_C53D045F73ED14B4 ON image (boxeur_id)');
    }
}
