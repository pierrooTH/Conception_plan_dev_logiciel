<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220127142715 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY FK_938720757F449E57');
        $this->addSql('DROP INDEX IDX_938720757F449E57 ON tache');
        $this->addSql('ALTER TABLE tache DROP id_id, DROP tache_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tache ADD id_id INT NOT NULL, ADD tache_id INT NOT NULL');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_938720757F449E57 FOREIGN KEY (id_id) REFERENCES previous_task (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_938720757F449E57 ON tache (id_id)');
    }
}
