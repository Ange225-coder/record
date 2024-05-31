<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240531131505 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE housing_configurations CHANGE home_equipment home_equipment JSON DEFAULT NULL AFTER housing_area, CHANGE my_language my_language JSON DEFAULT NULL AFTER car_park');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE housing_configurations CHANGE home_equipment home_equipment VARCHAR(128) DEFAULT NULL AFTER housing_area, CHANGE my_language my_language VARCHAR(55) DEFAULT NULL AFTER car_park');
    }
}
