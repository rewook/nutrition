<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230310001441 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ingredient_recette (id INT AUTO_INCREMENT NOT NULL, ingredient_id INT NOT NULL, recette_id INT NOT NULL, unite VARCHAR(255) NOT NULL, quantite INT NOT NULL, INDEX IDX_488C6856933FE08C (ingredient_id), INDEX IDX_488C685689312FE9 (recette_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ingredient_recette ADD CONSTRAINT FK_488C6856933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id)');
        $this->addSql('ALTER TABLE ingredient_recette ADD CONSTRAINT FK_488C685689312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ingredient_recette DROP FOREIGN KEY FK_488C6856933FE08C');
        $this->addSql('ALTER TABLE ingredient_recette DROP FOREIGN KEY FK_488C685689312FE9');
        $this->addSql('DROP TABLE ingredient_recette');
    }
}
