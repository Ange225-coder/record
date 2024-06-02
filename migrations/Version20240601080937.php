<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240601080937 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE housing_pictures (id INT AUTO_INCREMENT NOT NULL, housing_id INT NOT NULL, pictures JSON DEFAULT NULL, INDEX IDX_1A7A9821AD5873E3 (housing_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE housing_pictures ADD CONSTRAINT FK_1A7A9821AD5873E3 FOREIGN KEY (housing_id) REFERENCES housing_general_info (housing_id)');
        $this->addSql('ALTER TABLE pictures DROP FOREIGN KEY FK_8F7C2FC0AD5873E3');
        $this->addSql('DROP TABLE pictures');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pictures (id INT AUTO_INCREMENT NOT NULL, housing_id INT NOT NULL, pictures JSON DEFAULT NULL, INDEX IDX_8F7C2FC0AD5873E3 (housing_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE pictures ADD CONSTRAINT FK_8F7C2FC0AD5873E3 FOREIGN KEY (housing_id) REFERENCES housing_general_info (housing_id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE housing_pictures DROP FOREIGN KEY FK_1A7A9821AD5873E3');
        $this->addSql('DROP TABLE housing_pictures');
    }
}
