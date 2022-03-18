<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220318085437 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, zipcode VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE restaurant (id INT AUTO_INCREMENT NOT NULL, cityid_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, createdat DATE DEFAULT NULL, INDEX IDX_EB95123FC12FD324 (cityid_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE restaurant_picture (id INT AUTO_INCREMENT NOT NULL, restaurantid_id INT DEFAULT NULL, filename VARCHAR(255) DEFAULT NULL, INDEX IDX_DC9013FCE0777E28 (restaurantid_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE review (id INT AUTO_INCREMENT NOT NULL, restaurantid_id INT DEFAULT NULL, userid_id INT DEFAULT NULL, message LONGTEXT DEFAULT NULL, rating INT DEFAULT NULL, createdat DATE DEFAULT NULL, INDEX IDX_794381C6E0777E28 (restaurantid_id), INDEX IDX_794381C658E0A285 (userid_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, cityid_id INT DEFAULT NULL, username VARCHAR(255) DEFAULT NULL, password VARCHAR(255) DEFAULT NULL, INDEX IDX_8D93D649C12FD324 (cityid_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE restaurant ADD CONSTRAINT FK_EB95123FC12FD324 FOREIGN KEY (cityid_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE restaurant_picture ADD CONSTRAINT FK_DC9013FCE0777E28 FOREIGN KEY (restaurantid_id) REFERENCES restaurant (id)');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C6E0777E28 FOREIGN KEY (restaurantid_id) REFERENCES restaurant (id)');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C658E0A285 FOREIGN KEY (userid_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649C12FD324 FOREIGN KEY (cityid_id) REFERENCES city (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE restaurant DROP FOREIGN KEY FK_EB95123FC12FD324');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649C12FD324');
        $this->addSql('ALTER TABLE restaurant_picture DROP FOREIGN KEY FK_DC9013FCE0777E28');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C6E0777E28');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C658E0A285');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE restaurant');
        $this->addSql('DROP TABLE restaurant_picture');
        $this->addSql('DROP TABLE review');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
