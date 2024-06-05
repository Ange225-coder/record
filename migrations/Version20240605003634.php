<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240605003634 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE housing_pictures ADD teaser_pic VARCHAR(255) NOT NULL, ADD pic_two VARCHAR(255) DEFAULT NULL, ADD pic_three VARCHAR(255) DEFAULT NULL, ADD pic_for VARCHAR(255) DEFAULT NULL, ADD pic_five VARCHAR(255) DEFAULT NULL, ADD pic_six VARCHAR(255) DEFAULT NULL, DROP pictures');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE housing_pictures ADD pictures JSON NOT NULL, DROP teaser_pic, DROP pic_two, DROP pic_three, DROP pic_for, DROP pic_five, DROP pic_six');
    }
}
