<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211121184107 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE request DROP FOREIGN KEY FK_3B978F9FB03A8386');
        $this->addSql('DROP INDEX IDX_3B978F9FB03A8386 ON request');
        $this->addSql('ALTER TABLE request ADD user_email VARCHAR(180) DEFAULT NULL, DROP created_by_id');
        $this->addSql('ALTER TABLE request ADD CONSTRAINT FK_3B978F9F550872C FOREIGN KEY (user_email) REFERENCES user (email)');
        $this->addSql('CREATE INDEX IDX_3B978F9F550872C ON request (user_email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE request DROP FOREIGN KEY FK_3B978F9F550872C');
        $this->addSql('DROP INDEX IDX_3B978F9F550872C ON request');
        $this->addSql('ALTER TABLE request ADD created_by_id INT DEFAULT NULL, DROP user_email');
        $this->addSql('ALTER TABLE request ADD CONSTRAINT FK_3B978F9FB03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_3B978F9FB03A8386 ON request (created_by_id)');
    }
}
