<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220330062201 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE risk (id INT AUTO_INCREMENT NOT NULL, type_of_risk VARCHAR(255) NOT NULL, probability INT DEFAULT NULL, severity INT DEFAULT NULL, cost_risk_reduction VARCHAR(255) DEFAULT NULL, owner VARCHAR(255) DEFAULT NULL, means_detection VARCHAR(255) DEFAULT NULL, corrective_measures VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE previous_task');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE previous_task (id INT AUTO_INCREMENT NOT NULL, id_task_id INT NOT NULL, letter VARCHAR(1) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_A4B1B3E0532BA8F6 (id_task_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE previous_task ADD CONSTRAINT FK_A4B1B3E0532BA8F6 FOREIGN KEY (id_task_id) REFERENCES tache (id)');
        $this->addSql('DROP TABLE risk');
    }
}
