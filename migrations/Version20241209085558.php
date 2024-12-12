<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241209085558 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE absence_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE classe_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE cours_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE etudiant_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE niveau_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE semestre_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE absence (id INT NOT NULL, relation_id INT DEFAULT NULL, etudiant_id INT DEFAULT NULL, date_abs DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_765AE0C93256915B ON absence (relation_id)');
        $this->addSql('CREATE INDEX IDX_765AE0C9DDEAB1A3 ON absence (etudiant_id)');
        $this->addSql('CREATE TABLE classe (id INT NOT NULL, niveau_id INT NOT NULL, nom VARCHAR(20) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8F87BF96B3E9C81 ON classe (niveau_id)');
        $this->addSql('CREATE TABLE cours (id INT NOT NULL, date_cours VARCHAR(20) NOT NULL, heure_debut TIME(0) WITHOUT TIME ZONE NOT NULL, heure_fin TIME(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE etudiant (id INT NOT NULL, relation_id INT DEFAULT NULL, matricule VARCHAR(255) NOT NULL, nom_complet VARCHAR(25) NOT NULL, adress VARCHAR(20) DEFAULT NULL, login VARCHAR(255) NOT NULL, password VARCHAR(30) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_717E22E312B2DC9C ON etudiant (matricule)');
        $this->addSql('CREATE INDEX IDX_717E22E33256915B ON etudiant (relation_id)');
        $this->addSql('CREATE TABLE niveau (id INT NOT NULL, nom VARCHAR(20) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE semestre (id INT NOT NULL, nom VARCHAR(20) NOT NULL, etat VARCHAR(20) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('COMMENT ON COLUMN messenger_messages.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE absence ADD CONSTRAINT FK_765AE0C93256915B FOREIGN KEY (relation_id) REFERENCES etudiant (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE absence ADD CONSTRAINT FK_765AE0C9DDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiant (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE classe ADD CONSTRAINT FK_8F87BF96B3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E33256915B FOREIGN KEY (relation_id) REFERENCES classe (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE absence_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE classe_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE cours_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE etudiant_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE niveau_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE semestre_id_seq CASCADE');
        $this->addSql('ALTER TABLE absence DROP CONSTRAINT FK_765AE0C93256915B');
        $this->addSql('ALTER TABLE absence DROP CONSTRAINT FK_765AE0C9DDEAB1A3');
        $this->addSql('ALTER TABLE classe DROP CONSTRAINT FK_8F87BF96B3E9C81');
        $this->addSql('ALTER TABLE etudiant DROP CONSTRAINT FK_717E22E33256915B');
        $this->addSql('DROP TABLE absence');
        $this->addSql('DROP TABLE classe');
        $this->addSql('DROP TABLE cours');
        $this->addSql('DROP TABLE etudiant');
        $this->addSql('DROP TABLE niveau');
        $this->addSql('DROP TABLE semestre');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
