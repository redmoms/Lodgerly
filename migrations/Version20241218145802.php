<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241218145802 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE amenities (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lodging (id INT AUTO_INCREMENT NOT NULL, lodging_category_id INT NOT NULL, name VARCHAR(255) NOT NULL, adress VARCHAR(255) NOT NULL, price_per_night DOUBLE PRECISION NOT NULL, animals_allowed TINYINT(1) NOT NULL, simple_bed_count INT NOT NULL, double_bed_count INT NOT NULL, bedroom_count INT NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_8D35182AB308976F (lodging_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lodging_amenities (lodging_id INT NOT NULL, amenities_id INT NOT NULL, INDEX IDX_CD67503187335AF1 (lodging_id), INDEX IDX_CD675031B92D5262 (amenities_id), PRIMARY KEY(lodging_id, amenities_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lodging_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE picture (id INT AUTO_INCREMENT NOT NULL, lodge_id INT NOT NULL, link VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_16DB4F89B217AB93 (lodge_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, lodge_id INT NOT NULL, customer_id INT NOT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, customer_count INT NOT NULL, INDEX IDX_42C84955B217AB93 (lodge_id), INDEX IDX_42C849559395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE lodging ADD CONSTRAINT FK_8D35182AB308976F FOREIGN KEY (lodging_category_id) REFERENCES lodging_category (id)');
        $this->addSql('ALTER TABLE lodging_amenities ADD CONSTRAINT FK_CD67503187335AF1 FOREIGN KEY (lodging_id) REFERENCES lodging (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lodging_amenities ADD CONSTRAINT FK_CD675031B92D5262 FOREIGN KEY (amenities_id) REFERENCES amenities (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F89B217AB93 FOREIGN KEY (lodge_id) REFERENCES lodging (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955B217AB93 FOREIGN KEY (lodge_id) REFERENCES lodging (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849559395C3F3 FOREIGN KEY (customer_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lodging DROP FOREIGN KEY FK_8D35182AB308976F');
        $this->addSql('ALTER TABLE lodging_amenities DROP FOREIGN KEY FK_CD67503187335AF1');
        $this->addSql('ALTER TABLE lodging_amenities DROP FOREIGN KEY FK_CD675031B92D5262');
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F89B217AB93');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955B217AB93');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849559395C3F3');
        $this->addSql('DROP TABLE amenities');
        $this->addSql('DROP TABLE lodging');
        $this->addSql('DROP TABLE lodging_amenities');
        $this->addSql('DROP TABLE lodging_category');
        $this->addSql('DROP TABLE picture');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
