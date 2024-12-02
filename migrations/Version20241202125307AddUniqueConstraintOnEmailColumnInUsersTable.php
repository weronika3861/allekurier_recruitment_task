<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241202125307AddUniqueConstraintOnEmailColumnInUsersTable extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE UNIQUE INDEX unique_email ON users (email)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP INDEX unique_email ON users');
    }
}
