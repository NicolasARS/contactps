<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231025074509 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        // $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        // $this->addSql('ALTER TABLE contactos DROP zip_id, CHANGE provincia_id provincia_id INT NOT NULL');
        // $this->addSql('ALTER TABLE contactos RENAME INDEX fk_3446f2c54e7121af TO IDX_3446F2C54E7121AF');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE contactos ADD zip_id INT DEFAULT NULL, CHANGE provincia_id provincia_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contactos RENAME INDEX idx_3446f2c54e7121af TO FK_3446F2C54E7121AF');
    }
}
