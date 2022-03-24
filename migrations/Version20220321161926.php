<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220321161926 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE visiteurs_praticiens (visiteurs_id INT NOT NULL, praticiens_id INT NOT NULL, INDEX IDX_510D14BBBF668307 (visiteurs_id), INDEX IDX_510D14BB3D329473 (praticiens_id), PRIMARY KEY(visiteurs_id, praticiens_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE visiteurs_praticiens ADD CONSTRAINT FK_510D14BBBF668307 FOREIGN KEY (visiteurs_id) REFERENCES visiteurs (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE visiteurs_praticiens ADD CONSTRAINT FK_510D14BB3D329473 FOREIGN KEY (praticiens_id) REFERENCES praticiens (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE visiteurs_praticiens');
    }
}
