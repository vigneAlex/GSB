<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211124104430 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE visites (id INT AUTO_INCREMENT NOT NULL, vst_praticien_id INT DEFAULT NULL, vst_motif_id INT DEFAULT NULL, vst_visiteur_id INT DEFAULT NULL, vst_date_visite DATE NOT NULL, vst_commentaire LONGTEXT NOT NULL, INDEX IDX_470D3983F210BF63 (vst_praticien_id), INDEX IDX_470D398330E71ABC (vst_motif_id), INDEX IDX_470D3983452CCA99 (vst_visiteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE visites ADD CONSTRAINT FK_470D3983F210BF63 FOREIGN KEY (vst_praticien_id) REFERENCES praticiens (id)');
        $this->addSql('ALTER TABLE visites ADD CONSTRAINT FK_470D398330E71ABC FOREIGN KEY (vst_motif_id) REFERENCES motifs (id)');
        $this->addSql('ALTER TABLE visites ADD CONSTRAINT FK_470D3983452CCA99 FOREIGN KEY (vst_visiteur_id) REFERENCES visiteurs (id)');
        $this->addSql('ALTER TABLE praticiens CHANGE pra_nom pra_nom VARCHAR(255) NOT NULL, CHANGE pra_prenom pra_prenom VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE visites');
        $this->addSql('ALTER TABLE praticiens CHANGE pra_nom pra_nom VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE pra_prenom pra_prenom VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
