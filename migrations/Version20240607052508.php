<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240607052508 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE housing_for_individuals (id INT AUTO_INCREMENT NOT NULL, housing_id INT NOT NULL, first_name VARCHAR(125) NOT NULL, other_first_name VARCHAR(125) DEFAULT NULL, last_name VARCHAR(55) NOT NULL, email VARCHAR(128) NOT NULL, phone VARCHAR(55) NOT NULL, location VARCHAR(125) NOT NULL, first_address VARCHAR(120) NOT NULL, second_address VARCHAR(120) DEFAULT NULL, town VARCHAR(55) NOT NULL, postal_code VARCHAR(120) DEFAULT NULL, INDEX IDX_AD02A71FAD5873E3 (housing_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE housing_for_individuals ADD CONSTRAINT FK_AD02A71FAD5873E3 FOREIGN KEY (housing_id) REFERENCES housing_general_info (housing_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE housing_for_individuals DROP FOREIGN KEY FK_AD02A71FAD5873E3');
        $this->addSql('DROP TABLE housing_for_individuals');
    }
}
