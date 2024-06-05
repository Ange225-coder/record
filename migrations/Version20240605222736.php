<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240605222736 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE housing_price_and_schedule (id INT AUTO_INCREMENT NOT NULL, housing_id INT NOT NULL, how_to_reserve VARCHAR(55) NOT NULL, price_per_night INT NOT NULL, arrival_date VARCHAR(55) NOT NULL, avalaibility_synchronisation VARCHAR(55) NOT NULL, stay_of_more_than_thirty_nights VARCHAR(55) NOT NULL, INDEX IDX_FB144813AD5873E3 (housing_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE housing_price_and_schedule ADD CONSTRAINT FK_FB144813AD5873E3 FOREIGN KEY (housing_id) REFERENCES housing_general_info (housing_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE housing_price_and_schedule DROP FOREIGN KEY FK_FB144813AD5873E3');
        $this->addSql('DROP TABLE housing_price_and_schedule');
    }
}
