<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220613121537 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category CHANGE image image VARCHAR(255) DEFAULT NULL, CHANGE description description VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE command CHANGE payment_date payment_date DATETIME DEFAULT NULL, CHANGE payment_type payment_type VARCHAR(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE customer CHANGE individual_lastname individual_lastname VARCHAR(50) DEFAULT NULL, CHANGE individual_firstname individual_firstname VARCHAR(50) DEFAULT NULL, CHANGE professionnal_contact professionnal_contact VARCHAR(50) DEFAULT NULL, CHANGE professionnal_brand professionnal_brand VARCHAR(50) DEFAULT NULL, CHANGE professionnal_siren professionnal_siren VARCHAR(50) DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE product CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE shipping CHANGE delivery_date delivery_date DATE DEFAULT NULL, CHANGE tracking_number tracking_number VARCHAR(255) DEFAULT NULL, CHANGE details details VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category CHANGE image image VARCHAR(255) DEFAULT \'NULL\', CHANGE description description VARCHAR(255) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE command CHANGE payment_date payment_date DATETIME DEFAULT \'NULL\', CHANGE payment_type payment_type VARCHAR(1) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE customer CHANGE individual_lastname individual_lastname VARCHAR(50) DEFAULT \'NULL\', CHANGE individual_firstname individual_firstname VARCHAR(50) DEFAULT \'NULL\', CHANGE professionnal_contact professionnal_contact VARCHAR(50) DEFAULT \'NULL\', CHANGE professionnal_brand professionnal_brand VARCHAR(50) DEFAULT \'NULL\', CHANGE professionnal_siren professionnal_siren VARCHAR(50) DEFAULT \'NULL\', CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE product CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE shipping CHANGE delivery_date delivery_date DATE DEFAULT \'NULL\', CHANGE tracking_number tracking_number VARCHAR(255) DEFAULT \'NULL\', CHANGE details details VARCHAR(255) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`, CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
    }
}
