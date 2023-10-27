<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231027062642 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contactos ADD file VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE contactos RENAME INDEX fk_3446f2c54e7121af TO IDX_3446F2C54E7121AF');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contactos DROP file');
        $this->addSql('ALTER TABLE contactos RENAME INDEX idx_3446f2c54e7121af TO FK_3446F2C54E7121AF');
    }
}
