<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230306193100 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conseil ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE conseil ADD CONSTRAINT FK_3F3F0681A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_3F3F0681A76ED395 ON conseil (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conseil DROP FOREIGN KEY FK_3F3F0681A76ED395');
        $this->addSql('DROP INDEX IDX_3F3F0681A76ED395 ON conseil');
        $this->addSql('ALTER TABLE conseil DROP user_id');
    }
}
