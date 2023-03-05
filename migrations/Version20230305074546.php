<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230305074546 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conseil CHANGE type_cons_id type_cons_id INT NOT NULL');
        $this->addSql('ALTER TABLE reponse CHANGE conseil_id conseil_id INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conseil CHANGE type_cons_id type_cons_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reponse CHANGE conseil_id conseil_id INT NOT NULL');
    }
}
