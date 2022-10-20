<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221018233256 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F40C6E3A6');
        $this->addSql('DROP INDEX IDX_B6BD307F40C6E3A6 ON message');
        $this->addSql('ALTER TABLE message CHANGE user_contact_id contact_id INT NOT NULL');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FE7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id)');
        $this->addSql('CREATE INDEX IDX_B6BD307FE7A1254A ON message (contact_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FE7A1254A');
        $this->addSql('DROP INDEX IDX_B6BD307FE7A1254A ON message');
        $this->addSql('ALTER TABLE message CHANGE contact_id user_contact_id INT NOT NULL');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F40C6E3A6 FOREIGN KEY (user_contact_id) REFERENCES contact (id)');
        $this->addSql('CREATE INDEX IDX_B6BD307F40C6E3A6 ON message (user_contact_id)');
    }
}
