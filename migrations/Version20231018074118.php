<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231018074118 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        //$this->addSql('ALTER TABLE contactos DROP zip_id, CHANGE provincia_id provincia_id INT NOT NULL');
        //$this->addSql('ALTER TABLE contactos ADD CONSTRAINT FK_3446F2C54E7121AF FOREIGN KEY (provincia_id) REFERENCES provincia (id)');
        //$this->addSql('CREATE INDEX IDX_3446F2C54E7121AF ON contactos (provincia_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contactos DROP FOREIGN KEY FK_3446F2C54E7121AF');
        $this->addSql('DROP INDEX IDX_3446F2C54E7121AF ON contactos');
        $this->addSql('ALTER TABLE contactos ADD zip_id INT DEFAULT NULL, CHANGE provincia_id provincia_id INT DEFAULT NULL');
    }
}
