<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200325204641 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE application (id INT AUTO_INCREMENT NOT NULL, uid VARCHAR(255) NOT NULL, company_name VARCHAR(255) NOT NULL, company_iin VARCHAR(255) NOT NULL, director_full_name VARCHAR(255) NOT NULL, phone_number VARCHAR(255) NOT NULL, movement_area TINYTEXT NOT NULL, email VARCHAR(255) NOT NULL, external_id VARCHAR(255) NOT NULL, status INT NOT NULL, declined_reason TINYTEXT DEFAULT NULL, officer_full_name TINYTEXT DEFAULT NULL, reviewed_at DATE DEFAULT NULL, created_at DATE NOT NULL, updated_at DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE application_car (id INT AUTO_INCREMENT NOT NULL, application_id INT DEFAULT NULL, driver_full_name VARCHAR(255) NOT NULL, car_identifier VARCHAR(255) NOT NULL, INDEX IDX_F90233093E030ACD (application_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE application_car ADD CONSTRAINT FK_F90233093E030ACD FOREIGN KEY (application_id) REFERENCES application (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE application_car DROP FOREIGN KEY FK_F90233093E030ACD');
        $this->addSql('DROP TABLE application');
        $this->addSql('DROP TABLE application_car');
    }
}
