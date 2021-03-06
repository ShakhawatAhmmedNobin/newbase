<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160609130304 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE base_user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, locked TINYINT(1) NOT NULL, expired TINYINT(1) NOT NULL, expires_at DATETIME DEFAULT NULL, confirmation_token VARCHAR(255) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', credentials_expired TINYINT(1) NOT NULL, credentials_expire_at DATETIME DEFAULT NULL, username_canonical VARCHAR(191) NOT NULL, email_canonical VARCHAR(191) NOT NULL, UNIQUE INDEX UNIQ_1BF018B992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_1BF018B9A0D96FBF (email_canonical), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
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

        $this->addSql('DROP TABLE base_user');
        $this->addSql('ALTER TABLE amase_countries CHANGE code code VARCHAR(2) NOT NULL COLLATE latin1_swedish_ci');
        $this->addSql('ALTER TABLE amase_countries_en CHANGE ccode ccode VARCHAR(2) NOT NULL COLLATE latin1_swedish_ci');
        $this->addSql('ALTER TABLE amase_countrylist CHANGE ccode ccode VARCHAR(2) NOT NULL COLLATE latin1_swedish_ci');
        $this->addSql('ALTER TABLE amase_nationalities CHANGE nationality nationality VARCHAR(100) NOT NULL COLLATE latin1_swedish_ci');
    }
}
