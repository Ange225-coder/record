<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240709001649 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reservations (id INT AUTO_INCREMENT NOT NULL, housing_id INT NOT NULL, housing_choice VARCHAR(55) NOT NULL, housing_name VARCHAR(120) NOT NULL, housing_town VARCHAR(55) NOT NULL, housing_address VARCHAR(120) NOT NULL, housing_price INT NOT NULL, client_first_name VARCHAR(55) NOT NULL, client_last_name VARCHAR(55) NOT NULL, reservation_number INT NOT NULL, partner VARCHAR(55) NOT NULL, reservation_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE reservations');
    }
}
