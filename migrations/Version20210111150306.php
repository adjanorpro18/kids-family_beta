<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210111150306 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE type_needs ADD activity_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE type_needs ADD CONSTRAINT FK_6455391981C06096 FOREIGN KEY (activity_id) REFERENCES activity (id)');
        $this->addSql('CREATE INDEX IDX_6455391981C06096 ON type_needs (activity_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE type_needs DROP FOREIGN KEY FK_6455391981C06096');
        $this->addSql('DROP INDEX IDX_6455391981C06096 ON type_needs');
        $this->addSql('ALTER TABLE type_needs DROP activity_id');
    }
}
