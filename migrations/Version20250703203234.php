<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250703203234 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE clubes DROP FOREIGN KEY FK_A554B69F4FE90CDB');
        $this->addSql('ALTER TABLE clubes DROP FOREIGN KEY FK_A554B69FB8A54D43');
        $this->addSql('DROP INDEX IDX_A554B69F4FE90CDB ON clubes');
        $this->addSql('DROP INDEX IDX_A554B69FB8A54D43 ON clubes');
        $this->addSql('ALTER TABLE clubes DROP jugador_id, DROP entrenador_id');
        $this->addSql('ALTER TABLE entrenadores ADD club_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE entrenadores ADD CONSTRAINT FK_E15FDEE261190A32 FOREIGN KEY (club_id) REFERENCES clubes (id)');
        $this->addSql('CREATE INDEX IDX_E15FDEE261190A32 ON entrenadores (club_id)');
        $this->addSql('ALTER TABLE jugadores ADD club_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE jugadores ADD CONSTRAINT FK_CF491B7661190A32 FOREIGN KEY (club_id) REFERENCES clubes (id)');
        $this->addSql('CREATE INDEX IDX_CF491B7661190A32 ON jugadores (club_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE clubes ADD jugador_id INT DEFAULT NULL, ADD entrenador_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE clubes ADD CONSTRAINT FK_A554B69F4FE90CDB FOREIGN KEY (entrenador_id) REFERENCES entrenadores (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE clubes ADD CONSTRAINT FK_A554B69FB8A54D43 FOREIGN KEY (jugador_id) REFERENCES jugadores (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_A554B69F4FE90CDB ON clubes (entrenador_id)');
        $this->addSql('CREATE INDEX IDX_A554B69FB8A54D43 ON clubes (jugador_id)');
        $this->addSql('ALTER TABLE jugadores DROP FOREIGN KEY FK_CF491B7661190A32');
        $this->addSql('DROP INDEX IDX_CF491B7661190A32 ON jugadores');
        $this->addSql('ALTER TABLE jugadores DROP club_id');
        $this->addSql('ALTER TABLE entrenadores DROP FOREIGN KEY FK_E15FDEE261190A32');
        $this->addSql('DROP INDEX IDX_E15FDEE261190A32 ON entrenadores');
        $this->addSql('ALTER TABLE entrenadores DROP club_id');
    }
}
