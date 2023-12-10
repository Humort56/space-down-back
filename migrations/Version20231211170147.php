<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231211170147 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE card_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE lobby_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE player_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE card (id INT NOT NULL, name VARCHAR(255) NOT NULL, custom BOOLEAN NOT NULL, created_by VARCHAR(255) NOT NULL, temporary BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE lobby (id INT NOT NULL, uuid UUID NOT NULL, status VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN lobby.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE lobby_card (lobby_id INT NOT NULL, card_id INT NOT NULL, PRIMARY KEY(lobby_id, card_id))');
        $this->addSql('CREATE INDEX IDX_84527B2BB6612FD9 ON lobby_card (lobby_id)');
        $this->addSql('CREATE INDEX IDX_84527B2B4ACC9A20 ON lobby_card (card_id)');
        $this->addSql('CREATE TABLE player (id INT NOT NULL, lobby_id INT NOT NULL, uuid UUID NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_98197A65B6612FD9 ON player (lobby_id)');
        $this->addSql('ALTER TABLE lobby_card ADD CONSTRAINT FK_84527B2BB6612FD9 FOREIGN KEY (lobby_id) REFERENCES lobby (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE lobby_card ADD CONSTRAINT FK_84527B2B4ACC9A20 FOREIGN KEY (card_id) REFERENCES card (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A65B6612FD9 FOREIGN KEY (lobby_id) REFERENCES lobby (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE card_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE lobby_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE player_id_seq CASCADE');
        $this->addSql('ALTER TABLE lobby_card DROP CONSTRAINT FK_84527B2BB6612FD9');
        $this->addSql('ALTER TABLE lobby_card DROP CONSTRAINT FK_84527B2B4ACC9A20');
        $this->addSql('ALTER TABLE player DROP CONSTRAINT FK_98197A65B6612FD9');
        $this->addSql('DROP TABLE card');
        $this->addSql('DROP TABLE lobby');
        $this->addSql('DROP TABLE lobby_card');
        $this->addSql('DROP TABLE player');
    }
}
