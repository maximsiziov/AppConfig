<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231215103304 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE "asset_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "definition_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "asset" (id INT NOT NULL, hash VARCHAR(255) NOT NULL, platform VARCHAR(255) NOT NULL, major_version INT NOT NULL, minor_version INT NOT NULL, patch_version INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "definition" (id INT NOT NULL, hash VARCHAR(255) NOT NULL, platform VARCHAR(255) NOT NULL, major_version INT NOT NULL, minor_version INT NOT NULL, patch_version INT NOT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE "asset_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE "definition_id_seq" CASCADE');
        $this->addSql('DROP TABLE "asset"');
        $this->addSql('DROP TABLE "definition"');
    }
}
