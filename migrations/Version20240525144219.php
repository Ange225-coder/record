<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240525144219 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE housing_configurations (id INT AUTO_INCREMENT NOT NULL, housing_id INT NOT NULL, where_to_sleep VARCHAR(55) DEFAULT NULL, people_can_stay INT DEFAULT NULL, number_of_bathroom INT DEFAULT NULL, kids_is_accept VARCHAR(55) DEFAULT NULL, baby_bed VARCHAR(55) DEFAULT NULL, housing_area INT DEFAULT NULL, home_equipment VARCHAR(128) DEFAULT NULL, lunch VARCHAR(55) DEFAULT NULL, car_park VARCHAR(55) DEFAULT NULL, my_language VARCHAR(55) DEFAULT NULL, smoker VARCHAR(55) DEFAULT NULL, animal_is_accept VARCHAR(55) DEFAULT NULL, party_is_accept VARCHAR(55) DEFAULT NULL, profil VARCHAR(55) DEFAULT NULL, INDEX IDX_A250533DAD5873E3 (housing_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE housing_configurations ADD CONSTRAINT FK_A250533DAD5873E3 FOREIGN KEY (housing_id) REFERENCES housing_general_info (housing_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE housing_configurations DROP FOREIGN KEY FK_A250533DAD5873E3');
        $this->addSql('DROP TABLE housing_configurations');
    }
}
