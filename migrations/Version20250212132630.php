<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250212132630 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE job_offer ADD contrat_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE job_offer ADD CONSTRAINT FK_288A3A4E1823061F FOREIGN KEY (contrat_id) REFERENCES type_contrat (id)');
        $this->addSql('CREATE INDEX IDX_288A3A4E1823061F ON job_offer (contrat_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE job_offer DROP FOREIGN KEY FK_288A3A4E1823061F');
        $this->addSql('DROP INDEX IDX_288A3A4E1823061F ON job_offer');
        $this->addSql('ALTER TABLE job_offer DROP contrat_id');
    }
}
