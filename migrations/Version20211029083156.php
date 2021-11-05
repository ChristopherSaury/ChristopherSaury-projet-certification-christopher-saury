<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211029083156 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category CHANGE name name VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE dishes DROP available, CHANGE name name VARCHAR(45) NOT NULL, CHANGE description description VARCHAR(80) NOT NULL');
        $this->addSql('ALTER TABLE review ADD parent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C6727ACA70 FOREIGN KEY (parent_id) REFERENCES review (id)');
        $this->addSql('CREATE INDEX IDX_794381C6727ACA70 ON review (parent_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category CHANGE name name VARCHAR(90) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE dishes ADD available TINYINT(1) NOT NULL, CHANGE name name VARCHAR(90) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description description VARCHAR(90) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C6727ACA70');
        $this->addSql('DROP INDEX IDX_794381C6727ACA70 ON review');
        $this->addSql('ALTER TABLE review DROP parent_id');
    }
}
