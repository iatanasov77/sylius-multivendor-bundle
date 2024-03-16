<?php

declare(strict_types=1);

namespace Vankosoft\SyliusMultiVendor\DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240316180324 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sylius_shop_user ADD vendor_id INT DEFAULT NULL, ADD customer_type ENUM(\'customer\', \'vendor\')');
        $this->addSql('ALTER TABLE sylius_shop_user ADD CONSTRAINT FK_7C2B7480F603EE73 FOREIGN KEY (vendor_id) REFERENCES odiseo_vendor (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7C2B7480F603EE73 ON sylius_shop_user (vendor_id)');
        $this->addSql('ALTER TABLE messenger_messages CHANGE created_at created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE available_at available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE delivered_at delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE messenger_messages CHANGE created_at created_at DATETIME NOT NULL, CHANGE available_at available_at DATETIME NOT NULL, CHANGE delivered_at delivered_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE sylius_shop_user DROP FOREIGN KEY FK_7C2B7480F603EE73');
        $this->addSql('DROP INDEX UNIQ_7C2B7480F603EE73 ON sylius_shop_user');
        $this->addSql('ALTER TABLE sylius_shop_user DROP vendor_id, DROP customer_type');
    }
}
