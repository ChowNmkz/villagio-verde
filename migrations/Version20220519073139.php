<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220519073139 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE command (id INT AUTO_INCREMENT NOT NULL, order_date DATETIME NOT NULL, extra_discount NUMERIC(10, 2) NOT NULL, payment_date DATETIME DEFAULT NULL, payment_type VARCHAR(1) DEFAULT NULL, delivery_address VARCHAR(255) NOT NULL, delivery_zipcode VARCHAR(10) NOT NULL, delivery_city VARCHAR(50) NOT NULL, bill_address VARCHAR(255) NOT NULL, bill_zpicode VARCHAR(10) NOT NULL, bill_city VARCHAR(50) NOT NULL, status VARCHAR(50) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL, customer_coeff NUMERIC(10, 2) NOT NULL, bill_number VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, phone VARCHAR(10) NOT NULL, delivery_address VARCHAR(255) NOT NULL, delivery_zipcode VARCHAR(5) NOT NULL, delivery_city VARCHAR(50) NOT NULL, bill_address VARCHAR(255) NOT NULL, bill_zipcode VARCHAR(5) NOT NULL, bill_city VARCHAR(50) NOT NULL, coeff NUMERIC(10, 2) NOT NULL, individual_lastname VARCHAR(50) DEFAULT NULL, individual_firstname VARCHAR(50) DEFAULT NULL, professionnal_contact VARCHAR(50) DEFAULT NULL, professionnal_brand VARCHAR(50) DEFAULT NULL, professionnal_siren VARCHAR(50) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employee (id INT AUTO_INCREMENT NOT NULL, lastname VARCHAR(50) NOT NULL, firstname VARCHAR(50) NOT NULL, gender VARCHAR(1) NOT NULL, address VARCHAR(255) NOT NULL, city VARCHAR(50) NOT NULL, zipcode VARCHAR(5) NOT NULL, post VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shipping (id INT AUTO_INCREMENT NOT NULL, shipping_date DATETIME NOT NULL, delivery_date DATE DEFAULT NULL, tracking_number VARCHAR(255) DEFAULT NULL, details VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, username VARCHAR(50) NOT NULL, verify TINYINT(1) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE command');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE employee');
        $this->addSql('DROP TABLE shipping');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
