<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230309235947 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE allergene (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etape (id INT AUTO_INCREMENT NOT NULL, numero INT NOT NULL, description LONGTEXT NOT NULL, photo VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, photo VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recette (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, temps_prepa INT NOT NULL, temps_repos INT DEFAULT NULL, temps_cuisson INT DEFAULT NULL, public TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recette_etape (recette_id INT NOT NULL, etape_id INT NOT NULL, INDEX IDX_D4ABFD4B89312FE9 (recette_id), INDEX IDX_D4ABFD4B4A8CA2AD (etape_id), PRIMARY KEY(recette_id, etape_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recette_allergene (recette_id INT NOT NULL, allergene_id INT NOT NULL, INDEX IDX_20F5442B89312FE9 (recette_id), INDEX IDX_20F5442B4646AB2 (allergene_id), PRIMARY KEY(recette_id, allergene_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recette_regime (recette_id INT NOT NULL, regime_id INT NOT NULL, INDEX IDX_B316888589312FE9 (recette_id), INDEX IDX_B316888535E7D534 (regime_id), PRIMARY KEY(recette_id, regime_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE regime (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recette_etape ADD CONSTRAINT FK_D4ABFD4B89312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recette_etape ADD CONSTRAINT FK_D4ABFD4B4A8CA2AD FOREIGN KEY (etape_id) REFERENCES etape (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recette_allergene ADD CONSTRAINT FK_20F5442B89312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recette_allergene ADD CONSTRAINT FK_20F5442B4646AB2 FOREIGN KEY (allergene_id) REFERENCES allergene (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recette_regime ADD CONSTRAINT FK_B316888589312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recette_regime ADD CONSTRAINT FK_B316888535E7D534 FOREIGN KEY (regime_id) REFERENCES regime (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recette_etape DROP FOREIGN KEY FK_D4ABFD4B89312FE9');
        $this->addSql('ALTER TABLE recette_etape DROP FOREIGN KEY FK_D4ABFD4B4A8CA2AD');
        $this->addSql('ALTER TABLE recette_allergene DROP FOREIGN KEY FK_20F5442B89312FE9');
        $this->addSql('ALTER TABLE recette_allergene DROP FOREIGN KEY FK_20F5442B4646AB2');
        $this->addSql('ALTER TABLE recette_regime DROP FOREIGN KEY FK_B316888589312FE9');
        $this->addSql('ALTER TABLE recette_regime DROP FOREIGN KEY FK_B316888535E7D534');
        $this->addSql('DROP TABLE allergene');
        $this->addSql('DROP TABLE etape');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE recette');
        $this->addSql('DROP TABLE recette_etape');
        $this->addSql('DROP TABLE recette_allergene');
        $this->addSql('DROP TABLE recette_regime');
        $this->addSql('DROP TABLE regime');
    }
}
