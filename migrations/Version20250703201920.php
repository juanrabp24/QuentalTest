<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250703201920 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE clubes DROP FOREIGN KEY FK_A554B69F43D8FC4E');
        $this->addSql('ALTER TABLE clubes DROP FOREIGN KEY FK_A554B69F85F375B1');
        $this->addSql('DROP INDEX IDX_A554B69F43D8FC4E ON clubes');
        $this->addSql('DROP INDEX IDX_A554B69F85F375B1 ON clubes');
        $this->addSql('ALTER TABLE clubes ADD jugador_id INT DEFAULT NULL, ADD entrenador_id INT DEFAULT NULL, DROP jugadores_id_id, DROP entradores_id_id');
        $this->addSql('ALTER TABLE clubes ADD CONSTRAINT FK_A554B69FB8A54D43 FOREIGN KEY (jugador_id) REFERENCES jugadores (id)');
        $this->addSql('ALTER TABLE clubes ADD CONSTRAINT FK_A554B69F4FE90CDB FOREIGN KEY (entrenador_id) REFERENCES entrenadores (id)');
        $this->addSql('CREATE INDEX IDX_A554B69FB8A54D43 ON clubes (jugador_id)');
        $this->addSql('CREATE INDEX IDX_A554B69F4FE90CDB ON clubes (entrenador_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE clubes DROP FOREIGN KEY FK_A554B69FB8A54D43');
        $this->addSql('ALTER TABLE clubes DROP FOREIGN KEY FK_A554B69F4FE90CDB');
        $this->addSql('DROP INDEX IDX_A554B69FB8A54D43 ON clubes');
        $this->addSql('DROP INDEX IDX_A554B69F4FE90CDB ON clubes');
        $this->addSql('ALTER TABLE clubes ADD jugadores_id_id INT DEFAULT NULL, ADD entradores_id_id INT DEFAULT NULL, DROP jugador_id, DROP entrenador_id');
        $this->addSql('ALTER TABLE clubes ADD CONSTRAINT FK_A554B69F43D8FC4E FOREIGN KEY (jugadores_id_id) REFERENCES jugadores (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE clubes ADD CONSTRAINT FK_A554B69F85F375B1 FOREIGN KEY (entradores_id_id) REFERENCES entrenadores (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_A554B69F43D8FC4E ON clubes (jugadores_id_id)');
        $this->addSql('CREATE INDEX IDX_A554B69F85F375B1 ON clubes (entradores_id_id)');
    }
}
