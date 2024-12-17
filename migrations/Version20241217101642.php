<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20231217xxxxxx extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Change Product table id from integer to UUID';
    }

    public function up(Schema $schema): void
    {
        // Step 1: Drop the old id column
        $this->addSql('ALTER TABLE product DROP CONSTRAINT product_pkey');
        $this->addSql('ALTER TABLE product DROP COLUMN id');

        // Step 2: Add the new UUID id column
        $this->addSql('ALTER TABLE product ADD id UUID NOT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT product_pkey PRIMARY KEY (id)');

        // Step 3: Add UUID generation logic for new records
        $this->addSql("ALTER TABLE product ALTER COLUMN id SET DEFAULT uuid_generate_v4()");
    }

    public function down(Schema $schema): void
    {
        // Rollback: Drop the UUID column and recreate the integer id column
        $this->addSql('ALTER TABLE product DROP CONSTRAINT product_pkey');
        $this->addSql('ALTER TABLE product DROP COLUMN id');
        $this->addSql('ALTER TABLE product ADD id SERIAL NOT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT product_pkey PRIMARY KEY (id)');
    }
}
