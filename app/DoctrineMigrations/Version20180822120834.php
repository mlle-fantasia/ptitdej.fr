<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180822120834 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE prestataire');
        $this->addSql('ALTER TABLE entreprise CHANGE adresse adresse VARCHAR(255) NOT NULL, CHANGE codePostal codePostal VARCHAR(255) NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE prestataire (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, mail VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, adresse VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, codePostal VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, tel VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, UNIQUE INDEX UNIQ_60A264805126AC48 (mail), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE entreprise CHANGE adresse adresse VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE codePostal codePostal VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci');
    }
}
