<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211106141037 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dishes ADD subcategory_id INT NOT NULL');
        $this->addSql('ALTER TABLE dishes ADD CONSTRAINT FK_584DD35D5DC6FE57 FOREIGN KEY (subcategory_id) REFERENCES sub_category (id)');
        $this->addSql('CREATE INDEX IDX_584DD35D5DC6FE57 ON dishes (subcategory_id)');
        $this->addSql('ALTER TABLE sub_category ADD category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sub_category ADD CONSTRAINT FK_BCE3F79812469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_BCE3F79812469DE2 ON sub_category (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dishes DROP FOREIGN KEY FK_584DD35D5DC6FE57');
        $this->addSql('DROP INDEX IDX_584DD35D5DC6FE57 ON dishes');
        $this->addSql('ALTER TABLE dishes DROP subcategory_id');
        $this->addSql('ALTER TABLE sub_category DROP FOREIGN KEY FK_BCE3F79812469DE2');
        $this->addSql('DROP INDEX IDX_BCE3F79812469DE2 ON sub_category');
        $this->addSql('ALTER TABLE sub_category DROP category_id');
    }
}
