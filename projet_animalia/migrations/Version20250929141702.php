<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250929141702 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE genre (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE animals ADD type_id_id INT DEFAULT NULL, ADD genre_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE animals ADD CONSTRAINT FK_966C69DD714819A0 FOREIGN KEY (type_id_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE animals ADD CONSTRAINT FK_966C69DDC2428192 FOREIGN KEY (genre_id_id) REFERENCES genre (id)');
        $this->addSql('CREATE INDEX IDX_966C69DD714819A0 ON animals (type_id_id)');
        $this->addSql('CREATE INDEX IDX_966C69DDC2428192 ON animals (genre_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animals DROP FOREIGN KEY FK_966C69DDC2428192');
        $this->addSql('ALTER TABLE animals DROP FOREIGN KEY FK_966C69DD714819A0');
        $this->addSql('DROP TABLE genre');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP INDEX IDX_966C69DD714819A0 ON animals');
        $this->addSql('DROP INDEX IDX_966C69DDC2428192 ON animals');
        $this->addSql('ALTER TABLE animals DROP type_id_id, DROP genre_id_id');
    }
}
