<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211121184314 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE request DROP FOREIGN KEY FK_3B978F9F550872C');
        $this->addSql('DROP INDEX IDX_3B978F9F550872C ON request');
        $this->addSql('ALTER TABLE request ADD user_id INT DEFAULT NULL, DROP user_email');
        $this->addSql('ALTER TABLE request ADD CONSTRAINT FK_3B978F9FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_3B978F9FA76ED395 ON request (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE request DROP FOREIGN KEY FK_3B978F9FA76ED395');
        $this->addSql('DROP INDEX IDX_3B978F9FA76ED395 ON request');
        $this->addSql('ALTER TABLE request ADD user_email VARCHAR(180) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, DROP user_id');
        $this->addSql('ALTER TABLE request ADD CONSTRAINT FK_3B978F9F550872C FOREIGN KEY (user_email) REFERENCES user (email)');
        $this->addSql('CREATE INDEX IDX_3B978F9F550872C ON request (user_email)');
    }
}
