<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class VersionXXXXXX extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add created_at and updated_at columns to candidat table and handle foreign key constraint';
    }

    public function up(Schema $schema): void
    {
        // Drop the foreign key constraint
        $this->addSql('ALTER TABLE candidat DROP FOREIGN KEY FK_6AB5B471A76ED395');

        // Add the new columns
        $this->addSql('ALTER TABLE candidat ADD created_at DATETIME DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL');

        // Recreate the foreign key constraint
        $this->addSql('ALTER TABLE candidat ADD CONSTRAINT FK_6AB5B471A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // Drop the foreign key constraint
        $this->addSql('ALTER TABLE candidat DROP FOREIGN KEY FK_6AB5B471A76ED395');

        // Remove the new columns
        $this->addSql('ALTER TABLE candidat DROP created_at, DROP updated_at');

        // Recreate the foreign key constraint
        $this->addSql('ALTER TABLE candidat ADD CONSTRAINT FK_6AB5B471A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }
}