<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250209192232 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add ville and address columns to candidat table and handle foreign key constraint';
    }

    public function up(Schema $schema): void
    {
        // Drop the foreign key constraint
        $this->addSql('ALTER TABLE candidat DROP FOREIGN KEY FK_6AB5B471A76ED395');

        // Add the new columns
        $this->addSql('ALTER TABLE candidat ADD ville VARCHAR(255) DEFAULT NULL, ADD address VARCHAR(255) DEFAULT NULL');

        // Recreate the foreign key constraint
        $this->addSql('ALTER TABLE candidat ADD CONSTRAINT FK_6AB5B471A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // Drop the foreign key constraint
        $this->addSql('ALTER TABLE candidat DROP FOREIGN KEY FK_6AB5B471A76ED395');

        // Remove the new columns
        $this->addSql('ALTER TABLE candidat DROP ville, DROP address');

        // Recreate the foreign key constraint
        $this->addSql('ALTER TABLE candidat ADD CONSTRAINT FK_6AB5B471A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }
}