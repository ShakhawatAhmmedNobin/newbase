<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160609115158 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE amase_countries CHANGE code code VARCHAR(2) NOT NULL');
        $this->addSql('ALTER TABLE amase_countrylist CHANGE ccode ccode VARCHAR(2) NOT NULL');
        $this->addSql('ALTER TABLE amase_countries_en CHANGE ccode ccode VARCHAR(2) NOT NULL');
        $this->addSql('ALTER TABLE amase_nationalities CHANGE nationality nationality VARCHAR(100) NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE amase_countries CHANGE code code VARCHAR(2) NOT NULL COLLATE latin1_swedish_ci');
        $this->addSql('ALTER TABLE amase_countries_en CHANGE ccode ccode VARCHAR(2) NOT NULL COLLATE latin1_swedish_ci');
        $this->addSql('ALTER TABLE amase_countrylist CHANGE ccode ccode VARCHAR(2) NOT NULL COLLATE latin1_swedish_ci');
        $this->addSql('ALTER TABLE amase_nationalities CHANGE nationality nationality VARCHAR(100) NOT NULL COLLATE latin1_swedish_ci');
    }
}
