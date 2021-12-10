<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211118133743 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE detailaccident (id INT AUTO_INCREMENT NOT NULL, matricule VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, description_text VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE accident ADD detailaccident_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE accident ADD CONSTRAINT FK_8F31DB6FCE8915E2 FOREIGN KEY (detailaccident_id) REFERENCES detailaccident (id)');
        $this->addSql('CREATE INDEX IDX_8F31DB6FCE8915E2 ON accident (detailaccident_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE accident DROP FOREIGN KEY FK_8F31DB6FCE8915E2');
        $this->addSql('DROP TABLE detailaccident');
        $this->addSql('DROP INDEX IDX_8F31DB6FCE8915E2 ON accident');
        $this->addSql('ALTER TABLE accident DROP detailaccident_id');
    }
}
