<?php

namespace Database\Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20211109230525 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE historico_movimentos ADD produto_id UUID DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN historico_movimentos.produto_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE historico_movimentos ADD CONSTRAINT FK_90D624C8105CFD56 FOREIGN KEY (produto_id) REFERENCES produtos (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_90D624C8105CFD56 ON historico_movimentos (produto_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE historico_movimentos DROP CONSTRAINT FK_90D624C8105CFD56');
        $this->addSql('DROP INDEX IDX_90D624C8105CFD56');
        $this->addSql('ALTER TABLE historico_movimentos DROP produto_id');
    }
}
