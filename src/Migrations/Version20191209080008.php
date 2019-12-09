<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191209080008 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, mail VARCHAR(100) NOT NULL, phone INT DEFAULT NULL, mdp VARCHAR(255) NOT NULL, photo VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE animaux (id INT AUTO_INCREMENT NOT NULL, property_id INT DEFAULT NULL, type INT DEFAULT NULL, UNIQUE INDEX UNIQ_9ABE194D549213EC (property_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE annonces (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, animaux_id INT DEFAULT NULL, immobilier_id INT DEFAULT NULL, multimedia_id INT DEFAULT NULL, vehiculies_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, prix INT NOT NULL, lieu VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, sold TINYINT(1) NOT NULL, id_user INT NOT NULL, cat INT DEFAULT NULL, INDEX IDX_CB988C6FA76ED395 (user_id), UNIQUE INDEX UNIQ_CB988C6FA9DAECAA (animaux_id), UNIQUE INDEX UNIQ_CB988C6F5C7B99A9 (immobilier_id), UNIQUE INDEX UNIQ_CB988C6F20531EB8 (multimedia_id), UNIQUE INDEX UNIQ_CB988C6F319A17FF (vehiculies_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE immobilier (id INT AUTO_INCREMENT NOT NULL, property_id INT DEFAULT NULL, surface INT NOT NULL, nb_piece INT NOT NULL, type TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_142D24D2549213EC (property_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE multimedia (id INT AUTO_INCREMENT NOT NULL, property_id INT DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, marque VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_61312863549213EC (property_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE property (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, animaux_id INT DEFAULT NULL, immobilier_id INT DEFAULT NULL, multimedia_id INT DEFAULT NULL, vehicules_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, prix INT NOT NULL, lieu VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, sold TINYINT(1) DEFAULT \'0\' NOT NULL, id_user INT NOT NULL, cat INT DEFAULT NULL, INDEX IDX_8BF21CDEA76ED395 (user_id), UNIQUE INDEX UNIQ_8BF21CDEA9DAECAA (animaux_id), UNIQUE INDEX UNIQ_8BF21CDE5C7B99A9 (immobilier_id), UNIQUE INDEX UNIQ_8BF21CDE20531EB8 (multimedia_id), UNIQUE INDEX UNIQ_8BF21CDE8D8BD7E2 (vehicules_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicules (id INT AUTO_INCREMENT NOT NULL, property_id INT DEFAULT NULL, type INT DEFAULT NULL, nb_km INT NOT NULL, energie VARCHAR(50) NOT NULL, annee INT NOT NULL, UNIQUE INDEX UNIQ_78218C2D549213EC (property_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voitures (id INT AUTO_INCREMENT NOT NULL, marque VARCHAR(50) NOT NULL, nb_km INT NOT NULL, energie VARCHAR(50) NOT NULL, annee DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE animaux ADD CONSTRAINT FK_9ABE194D549213EC FOREIGN KEY (property_id) REFERENCES property (id)');
        $this->addSql('ALTER TABLE annonces ADD CONSTRAINT FK_CB988C6FA76ED395 FOREIGN KEY (user_id) REFERENCES admin (id)');
        $this->addSql('ALTER TABLE annonces ADD CONSTRAINT FK_CB988C6FA9DAECAA FOREIGN KEY (animaux_id) REFERENCES animaux (id)');
        $this->addSql('ALTER TABLE annonces ADD CONSTRAINT FK_CB988C6F5C7B99A9 FOREIGN KEY (immobilier_id) REFERENCES immobilier (id)');
        $this->addSql('ALTER TABLE annonces ADD CONSTRAINT FK_CB988C6F20531EB8 FOREIGN KEY (multimedia_id) REFERENCES multimedia (id)');
        $this->addSql('ALTER TABLE annonces ADD CONSTRAINT FK_CB988C6F319A17FF FOREIGN KEY (vehiculies_id) REFERENCES vehicules (id)');
        $this->addSql('ALTER TABLE immobilier ADD CONSTRAINT FK_142D24D2549213EC FOREIGN KEY (property_id) REFERENCES property (id)');
        $this->addSql('ALTER TABLE multimedia ADD CONSTRAINT FK_61312863549213EC FOREIGN KEY (property_id) REFERENCES property (id)');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDEA76ED395 FOREIGN KEY (user_id) REFERENCES admin (id)');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDEA9DAECAA FOREIGN KEY (animaux_id) REFERENCES animaux (id)');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDE5C7B99A9 FOREIGN KEY (immobilier_id) REFERENCES immobilier (id)');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDE20531EB8 FOREIGN KEY (multimedia_id) REFERENCES multimedia (id)');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDE8D8BD7E2 FOREIGN KEY (vehicules_id) REFERENCES vehicules (id)');
        $this->addSql('ALTER TABLE vehicules ADD CONSTRAINT FK_78218C2D549213EC FOREIGN KEY (property_id) REFERENCES property (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE annonces DROP FOREIGN KEY FK_CB988C6FA76ED395');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDEA76ED395');
        $this->addSql('ALTER TABLE annonces DROP FOREIGN KEY FK_CB988C6FA9DAECAA');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDEA9DAECAA');
        $this->addSql('ALTER TABLE annonces DROP FOREIGN KEY FK_CB988C6F5C7B99A9');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDE5C7B99A9');
        $this->addSql('ALTER TABLE annonces DROP FOREIGN KEY FK_CB988C6F20531EB8');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDE20531EB8');
        $this->addSql('ALTER TABLE animaux DROP FOREIGN KEY FK_9ABE194D549213EC');
        $this->addSql('ALTER TABLE immobilier DROP FOREIGN KEY FK_142D24D2549213EC');
        $this->addSql('ALTER TABLE multimedia DROP FOREIGN KEY FK_61312863549213EC');
        $this->addSql('ALTER TABLE vehicules DROP FOREIGN KEY FK_78218C2D549213EC');
        $this->addSql('ALTER TABLE annonces DROP FOREIGN KEY FK_CB988C6F319A17FF');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDE8D8BD7E2');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE animaux');
        $this->addSql('DROP TABLE annonces');
        $this->addSql('DROP TABLE immobilier');
        $this->addSql('DROP TABLE multimedia');
        $this->addSql('DROP TABLE property');
        $this->addSql('DROP TABLE vehicules');
        $this->addSql('DROP TABLE voitures');
    }
}
