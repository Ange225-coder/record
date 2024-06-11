<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240611080255 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE housing_finalization (id INT AUTO_INCREMENT NOT NULL, housing_id INT NOT NULL, social_reason VARCHAR(125) DEFAULT NULL, first_name VARCHAR(125) NOT NULL, other_first_name VARCHAR(125) DEFAULT NULL, last_name VARCHAR(55) NOT NULL, email VARCHAR(128) NOT NULL, phone VARCHAR(55) NOT NULL, location VARCHAR(125) NOT NULL, first_address VARCHAR(120) NOT NULL, second_address VARCHAR(120) DEFAULT NULL, town VARCHAR(55) NOT NULL, postal_code VARCHAR(120) DEFAULT NULL, partner VARCHAR(55) NOT NULL, INDEX IDX_174D3850AD5873E3 (housing_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE housing_finalization ADD CONSTRAINT FK_174D3850AD5873E3 FOREIGN KEY (housing_id) REFERENCES housing_general_info (housing_id)');
        $this->addSql('ALTER TABLE housing_for_individuals DROP FOREIGN KEY FK_AD02A71FAD5873E3');
        $this->addSql('ALTER TABLE housing_for_commercial_entity DROP FOREIGN KEY FK_DE6FC34FAD5873E3');
        $this->addSql('DROP TABLE housing_for_individuals');
        $this->addSql('DROP TABLE housing_for_commercial_entity');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE housing_for_individuals (id INT AUTO_INCREMENT NOT NULL, housing_id INT NOT NULL, first_name VARCHAR(125) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, other_first_name VARCHAR(125) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, last_name VARCHAR(55) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, email VARCHAR(128) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, phone VARCHAR(55) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, location VARCHAR(125) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, first_address VARCHAR(120) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, second_address VARCHAR(120) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, town VARCHAR(55) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, postal_code VARCHAR(120) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_AD02A71FAD5873E3 (housing_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE housing_for_commercial_entity (id INT AUTO_INCREMENT NOT NULL, housing_id INT NOT NULL, social_reason VARCHAR(128) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, first_name VARCHAR(125) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, other_first_name VARCHAR(125) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, last_name VARCHAR(55) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, email VARCHAR(128) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, phone VARCHAR(55) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, location VARCHAR(125) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, first_address VARCHAR(120) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, second_address VARCHAR(120) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, town VARCHAR(55) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, postal_code VARCHAR(120) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_DE6FC34FAD5873E3 (housing_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE housing_for_individuals ADD CONSTRAINT FK_AD02A71FAD5873E3 FOREIGN KEY (housing_id) REFERENCES housing_general_info (housing_id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE housing_for_commercial_entity ADD CONSTRAINT FK_DE6FC34FAD5873E3 FOREIGN KEY (housing_id) REFERENCES housing_general_info (housing_id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE housing_finalization DROP FOREIGN KEY FK_174D3850AD5873E3');
        $this->addSql('DROP TABLE housing_finalization');
    }
}
