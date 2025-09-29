<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250929142220 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reviews ADD animals_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reviews ADD CONSTRAINT FK_6970EB0F132B9E58 FOREIGN KEY (animals_id) REFERENCES animals (id)');
        $this->addSql('CREATE INDEX IDX_6970EB0F132B9E58 ON reviews (animals_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reviews DROP FOREIGN KEY FK_6970EB0F132B9E58');
        $this->addSql('DROP INDEX IDX_6970EB0F132B9E58 ON reviews');
        $this->addSql('ALTER TABLE reviews DROP animals_id');
    }
}
