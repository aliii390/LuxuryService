<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250210111616 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gender ADD candidat_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE gender ADD CONSTRAINT FK_C7470A428D0EB82 FOREIGN KEY (candidat_id) REFERENCES candidat (id)');
        $this->addSql('CREATE INDEX IDX_C7470A428D0EB82 ON gender (candidat_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gender DROP FOREIGN KEY FK_C7470A428D0EB82');
        $this->addSql('DROP INDEX IDX_C7470A428D0EB82 ON gender');
        $this->addSql('ALTER TABLE gender DROP candidat_id');
    }
}
