<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231018065646 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        //$this->addSql('ALTER TABLE contactos ADD provincia_id INT NOT NULL, ADD zip_id INT NOT NULL');
        // $this->addSql('ALTER TABLE contactos ADD CONSTRAINT FK_3446F2C54E7121AF FOREIGN KEY (provincia_id) REFERENCES provincia (id)');
        // $this->addSql('ALTER TABLE contactos ADD CONSTRAINT FK_3446F2C57D662686 FOREIGN KEY (zip_id) REFERENCES provincia (id)');
        // $this->addSql('CREATE INDEX IDX_3446F2C54E7121AF ON contactos (provincia_id)');
        // $this->addSql('CREATE INDEX IDX_3446F2C57D662686 ON contactos (zip_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contactos DROP FOREIGN KEY FK_3446F2C54E7121AF');
        $this->addSql('ALTER TABLE contactos DROP FOREIGN KEY FK_3446F2C57D662686');
        $this->addSql('DROP INDEX IDX_3446F2C54E7121AF ON contactos');
        $this->addSql('DROP INDEX IDX_3446F2C57D662686 ON contactos');
        $this->addSql('ALTER TABLE contactos DROP provincia_id, DROP zip_id');
    }
}
