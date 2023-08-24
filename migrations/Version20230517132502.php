<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230517132502 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $users = $schema->createTable('table');
        $users->addColumn('id', Types::INTEGER)->setAutoincrement(true);
        $users->addColumn('user_name',Types::STRING);
        $users->addColumn('created_at',Types::DATE_MUTABLE);
        $users->setPrimaryKey(['id']);
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable('table');
    }
}
