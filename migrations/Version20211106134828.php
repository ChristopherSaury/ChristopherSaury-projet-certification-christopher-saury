<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211106134828 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dishes ADD sub_category_id INT NOT NULL');
        $this->addSql('ALTER TABLE dishes ADD CONSTRAINT FK_584DD35DF7BFE87C FOREIGN KEY (sub_category_id) REFERENCES sub_category (id)');
        $this->addSql('CREATE INDEX IDX_584DD35DF7BFE87C ON dishes (sub_category_id)');
        $this->addSql('ALTER TABLE review CHANGE publication_date publication_date DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dishes DROP FOREIGN KEY FK_584DD35DF7BFE87C');
        $this->addSql('DROP INDEX IDX_584DD35DF7BFE87C ON dishes');
        $this->addSql('ALTER TABLE dishes DROP sub_category_id');
        $this->addSql('ALTER TABLE review CHANGE publication_date publication_date DATE NOT NULL');
    }
}
