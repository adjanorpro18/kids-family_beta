<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210111145005 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE type_activity ADD activity_id INT NOT NULL');
        $this->addSql('ALTER TABLE type_activity ADD CONSTRAINT FK_618B2EA681C06096 FOREIGN KEY (activity_id) REFERENCES activity (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_618B2EA681C06096 ON type_activity (activity_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE type_activity DROP FOREIGN KEY FK_618B2EA681C06096');
        $this->addSql('DROP INDEX UNIQ_618B2EA681C06096 ON type_activity');
        $this->addSql('ALTER TABLE type_activity DROP activity_id');
    }
}
