<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220330130741 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image_cours ADD image VARCHAR(255) DEFAULT NULL, ADD image_file LONGBLOB DEFAULT NULL, ADD updates_at DATETIME DEFAULT NULL, DROP contenu');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image_cours ADD contenu LONGTEXT DEFAULT NULL, DROP image, DROP image_file, DROP updates_at');
    }
}
