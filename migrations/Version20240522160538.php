<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240522160538 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE housing_general_info (housing_id INT AUTO_INCREMENT NOT NULL, housing_choice VARCHAR(55) DEFAULT NULL, housing_already_registered VARCHAR(55) DEFAULT NULL, housing_name VARCHAR(55) DEFAULT NULL, housing_country VARCHAR(55) DEFAULT NULL, housing_address VARCHAR(55) DEFAULT NULL, postal_code VARCHAR(55) DEFAULT NULL, housing_town VARCHAR(55) DEFAULT NULL, partner VARCHAR(55) DEFAULT NULL, PRIMARY KEY(housing_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE housing_general_info');
    }
}
