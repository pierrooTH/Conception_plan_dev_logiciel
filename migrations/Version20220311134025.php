<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220311134025 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE previous_task');
        $this->addSql('ALTER TABLE tache ADD previousLetter VARCHAR(5) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_938720758E02EE0A ON tache (letter)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE previous_task (id INT AUTO_INCREMENT NOT NULL, id_task_id INT NOT NULL, letter VARCHAR(1) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_A4B1B3E0532BA8F6 (id_task_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE previous_task ADD CONSTRAINT FK_A4B1B3E0532BA8F6 FOREIGN KEY (id_task_id) REFERENCES tache (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('DROP INDEX UNIQ_938720758E02EE0A ON tache');
        $this->addSql('ALTER TABLE tache DROP previousLetter');
    }
}
