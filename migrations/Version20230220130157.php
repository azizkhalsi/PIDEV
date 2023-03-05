<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230220130157 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE type_cons (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE conseil ADD type_cons_id INT NOT NULL');
        $this->addSql('ALTER TABLE conseil ADD CONSTRAINT FK_3F3F068130398100 FOREIGN KEY (type_cons_id) REFERENCES type_cons (id)');
        $this->addSql('CREATE INDEX IDX_3F3F068130398100 ON conseil (type_cons_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conseil DROP FOREIGN KEY FK_3F3F068130398100');
        $this->addSql('DROP TABLE type_cons');
        $this->addSql('DROP INDEX IDX_3F3F068130398100 ON conseil');
        $this->addSql('ALTER TABLE conseil DROP type_cons_id');
    }
}
