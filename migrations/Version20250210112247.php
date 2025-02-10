<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250210112247 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidat ADD gender_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE candidat ADD CONSTRAINT FK_6AB5B471708A0E0 FOREIGN KEY (gender_id) REFERENCES gender (id)');
        $this->addSql('CREATE INDEX IDX_6AB5B471708A0E0 ON candidat (gender_id)');
        $this->addSql('ALTER TABLE gender DROP FOREIGN KEY FK_C7470A428D0EB82');
        $this->addSql('DROP INDEX IDX_C7470A428D0EB82 ON gender');
        $this->addSql('ALTER TABLE gender DROP candidat_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidat DROP FOREIGN KEY FK_6AB5B471708A0E0');
        $this->addSql('DROP INDEX IDX_6AB5B471708A0E0 ON candidat');
        $this->addSql('ALTER TABLE candidat DROP gender_id');
        $this->addSql('ALTER TABLE gender ADD candidat_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE gender ADD CONSTRAINT FK_C7470A428D0EB82 FOREIGN KEY (candidat_id) REFERENCES candidat (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_C7470A428D0EB82 ON gender (candidat_id)');
    }
}
