<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220622223548 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categoria (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(200) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE filme (id INT AUTO_INCREMENT NOT NULL, upload_utilizador_id INT NOT NULL, categoria_id INT NOT NULL, produtora VARCHAR(100) NOT NULL, titulo VARCHAR(200) NOT NULL, INDEX IDX_3A387F00A3873AAC (upload_utilizador_id), INDEX IDX_3A387F003397707A (categoria_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pessoa (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(200) NOT NULL, idade INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pessoa_filme (pessoa_id INT NOT NULL, filme_id INT NOT NULL, INDEX IDX_8F847B13DF6FA0A5 (pessoa_id), INDEX IDX_8F847B13E6E418AD (filme_id), PRIMARY KEY(pessoa_id, filme_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pessoa_pessoa (pessoa_source INT NOT NULL, pessoa_target INT NOT NULL, INDEX IDX_98D45658DB8182A9 (pessoa_source), INDEX IDX_98D45658C264D226 (pessoa_target), PRIMARY KEY(pessoa_source, pessoa_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produtora (id INT AUTO_INCREMENT NOT NULL, descricao VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilizador (id INT AUTO_INCREMENT NOT NULL, pessoa_id INT NOT NULL, username VARCHAR(100) NOT NULL, email VARCHAR(100) NOT NULL, password VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_D1A41B6CDF6FA0A5 (pessoa_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE filme ADD CONSTRAINT FK_3A387F00A3873AAC FOREIGN KEY (upload_utilizador_id) REFERENCES utilizador (id)');
        $this->addSql('ALTER TABLE filme ADD CONSTRAINT FK_3A387F003397707A FOREIGN KEY (categoria_id) REFERENCES categoria (id)');
        $this->addSql('ALTER TABLE pessoa_filme ADD CONSTRAINT FK_8F847B13DF6FA0A5 FOREIGN KEY (pessoa_id) REFERENCES pessoa (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pessoa_filme ADD CONSTRAINT FK_8F847B13E6E418AD FOREIGN KEY (filme_id) REFERENCES filme (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pessoa_pessoa ADD CONSTRAINT FK_98D45658DB8182A9 FOREIGN KEY (pessoa_source) REFERENCES pessoa (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pessoa_pessoa ADD CONSTRAINT FK_98D45658C264D226 FOREIGN KEY (pessoa_target) REFERENCES pessoa (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilizador ADD CONSTRAINT FK_D1A41B6CDF6FA0A5 FOREIGN KEY (pessoa_id) REFERENCES pessoa (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE filme DROP FOREIGN KEY FK_3A387F003397707A');
        $this->addSql('ALTER TABLE pessoa_filme DROP FOREIGN KEY FK_8F847B13E6E418AD');
        $this->addSql('ALTER TABLE pessoa_filme DROP FOREIGN KEY FK_8F847B13DF6FA0A5');
        $this->addSql('ALTER TABLE pessoa_pessoa DROP FOREIGN KEY FK_98D45658DB8182A9');
        $this->addSql('ALTER TABLE pessoa_pessoa DROP FOREIGN KEY FK_98D45658C264D226');
        $this->addSql('ALTER TABLE utilizador DROP FOREIGN KEY FK_D1A41B6CDF6FA0A5');
        $this->addSql('ALTER TABLE filme DROP FOREIGN KEY FK_3A387F00A3873AAC');
        $this->addSql('DROP TABLE categoria');
        $this->addSql('DROP TABLE filme');
        $this->addSql('DROP TABLE pessoa');
        $this->addSql('DROP TABLE pessoa_filme');
        $this->addSql('DROP TABLE pessoa_pessoa');
        $this->addSql('DROP TABLE produtora');
        $this->addSql('DROP TABLE utilizador');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
