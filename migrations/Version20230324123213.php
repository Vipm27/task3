<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230324123213 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE book (id INT AUTO_INCREMENT NOT NULL, author VARCHAR(255) DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE setting DROP FOREIGN KEY FK_9F74B898D173940B');
        $this->addSql('ALTER TABLE data DROP FOREIGN KEY FK_ADF3F363AFC2B591');
        $this->addSql('ALTER TABLE user_module DROP FOREIGN KEY FK_69763D157648EE39');
        $this->addSql('ALTER TABLE user_module DROP FOREIGN KEY FK_69763D159D86650F');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C24262836EC6D36');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C242628714819A0');
        $this->addSql('ALTER TABLE type DROP FOREIGN KEY FK_8CDE5729D173940B');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE setting');
        $this->addSql('DROP TABLE data');
        $this->addSql('DROP TABLE user_module');
        $this->addSql('DROP TABLE recommendation');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE module');
        $this->addSql('DROP TABLE type');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE setting (id INT AUTO_INCREMENT NOT NULL, recommendation_id INT DEFAULT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, temperature_setting DOUBLE PRECISION NOT NULL, humidity_setting DOUBLE PRECISION NOT NULL, illumination_setting DOUBLE PRECISION NOT NULL, INDEX IDX_9F74B898D173940B (recommendation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE data (id INT AUTO_INCREMENT NOT NULL, module_id INT DEFAULT NULL, humidity DOUBLE PRECISION NOT NULL, temperature DOUBLE PRECISION NOT NULL, illumination INT NOT NULL, measurements_date DATETIME NOT NULL, INDEX IDX_ADF3F363AFC2B591 (module_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE user_module (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, module_id_id INT DEFAULT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, linked_at DATETIME NOT NULL, INDEX IDX_69763D159D86650F (user_id_id), INDEX IDX_69763D157648EE39 (module_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE recommendation (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, temperature_min DOUBLE PRECISION NOT NULL, temperature_max DOUBLE PRECISION NOT NULL, humidity_min DOUBLE PRECISION NOT NULL, humidity_max DOUBLE PRECISION NOT NULL, illumination_min DOUBLE PRECISION NOT NULL, illumination_max DOUBLE PRECISION NOT NULL, description_care LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME NOT NULL, modified_at DATETIME NOT NULL, created_by INT NOT NULL, modified_by INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, password VARCHAR(16) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME NOT NULL, modified_at DATETIME NOT NULL, modified_by INT NOT NULL, status LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, role_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE module (id INT AUTO_INCREMENT NOT NULL, setting_id_id INT DEFAULT NULL, type_id_id INT DEFAULT NULL, api_key INT NOT NULL, status LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_C24262836EC6D36 (setting_id_id), INDEX IDX_C242628714819A0 (type_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, recommendation_id INT DEFAULT NULL, description LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_by INT NOT NULL, modified_at DATETIME NOT NULL, modified_by INT NOT NULL, INDEX IDX_8CDE5729D173940B (recommendation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE setting ADD CONSTRAINT FK_9F74B898D173940B FOREIGN KEY (recommendation_id) REFERENCES recommendation (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE data ADD CONSTRAINT FK_ADF3F363AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE user_module ADD CONSTRAINT FK_69763D157648EE39 FOREIGN KEY (module_id_id) REFERENCES module (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE user_module ADD CONSTRAINT FK_69763D159D86650F FOREIGN KEY (user_id_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C24262836EC6D36 FOREIGN KEY (setting_id_id) REFERENCES setting (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C242628714819A0 FOREIGN KEY (type_id_id) REFERENCES type (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE type ADD CONSTRAINT FK_8CDE5729D173940B FOREIGN KEY (recommendation_id) REFERENCES recommendation (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('DROP TABLE book');
    }
}
