<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250209165542 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Remove created_at and updated_at columns from candidat table';
    }

    public function up(Schema $schema): void
    {
        // Remove the columns
        $this->addSql('ALTER TABLE candidat DROP created_at, DROP updated_at');
    }

    public function down(Schema $schema): void
    {
        // Re-add the columns if needed
        $this->addSql('ALTER TABLE candidat ADD created_at DATETIME DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL');
    }
}