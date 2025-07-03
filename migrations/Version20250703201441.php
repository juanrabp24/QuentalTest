<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250703201441 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE clubes (id INT AUTO_INCREMENT NOT NULL, jugadores_id_id INT DEFAULT NULL, entradores_id_id INT DEFAULT NULL, nombre VARCHAR(255) DEFAULT NULL, estadio VARCHAR(255) DEFAULT NULL, liga VARCHAR(255) DEFAULT NULL, presupuesto INT DEFAULT NULL, INDEX IDX_A554B69F43D8FC4E (jugadores_id_id), INDEX IDX_A554B69F85F375B1 (entradores_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE clubes ADD CONSTRAINT FK_A554B69F43D8FC4E FOREIGN KEY (jugadores_id_id) REFERENCES jugadores (id)');
        $this->addSql('ALTER TABLE clubes ADD CONSTRAINT FK_A554B69F85F375B1 FOREIGN KEY (entradores_id_id) REFERENCES entrenadores (id)');
        $this->addSql('ALTER TABLE entrenadores DROP baja');
        $this->addSql('ALTER TABLE jugadores DROP baja');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE clubes DROP FOREIGN KEY FK_A554B69F43D8FC4E');
        $this->addSql('ALTER TABLE clubes DROP FOREIGN KEY FK_A554B69F85F375B1');
        $this->addSql('DROP TABLE clubes');
        $this->addSql('ALTER TABLE entrenadores ADD baja TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE jugadores ADD baja TINYINT(1) DEFAULT NULL');
    }
}
