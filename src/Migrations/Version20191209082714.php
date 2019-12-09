<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191209082714 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDE5C7B99A9');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDE8D8BD7E2');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDEA9DAECAA');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDE5C7B99A9 FOREIGN KEY (immobilier_id) REFERENCES immobilier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDE8D8BD7E2 FOREIGN KEY (vehicules_id) REFERENCES vehicules (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDEA9DAECAA FOREIGN KEY (animaux_id) REFERENCES animaux (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE animaux DROP FOREIGN KEY FK_9ABE194D549213EC');
        $this->addSql('ALTER TABLE animaux ADD CONSTRAINT FK_9ABE194D549213EC FOREIGN KEY (property_id) REFERENCES property (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE immobilier DROP FOREIGN KEY FK_142D24D2549213EC');
        $this->addSql('ALTER TABLE immobilier ADD CONSTRAINT FK_142D24D2549213EC FOREIGN KEY (property_id) REFERENCES property (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE vehicules DROP FOREIGN KEY FK_78218C2D549213EC');
        $this->addSql('ALTER TABLE vehicules ADD CONSTRAINT FK_78218C2D549213EC FOREIGN KEY (property_id) REFERENCES property (id) ON DELETE SET NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE animaux DROP FOREIGN KEY FK_9ABE194D549213EC');
        $this->addSql('ALTER TABLE animaux ADD CONSTRAINT FK_9ABE194D549213EC FOREIGN KEY (property_id) REFERENCES property (id)');
        $this->addSql('ALTER TABLE immobilier DROP FOREIGN KEY FK_142D24D2549213EC');
        $this->addSql('ALTER TABLE immobilier ADD CONSTRAINT FK_142D24D2549213EC FOREIGN KEY (property_id) REFERENCES property (id)');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDEA9DAECAA');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDE5C7B99A9');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDE8D8BD7E2');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDEA9DAECAA FOREIGN KEY (animaux_id) REFERENCES animaux (id)');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDE5C7B99A9 FOREIGN KEY (immobilier_id) REFERENCES immobilier (id)');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDE8D8BD7E2 FOREIGN KEY (vehicules_id) REFERENCES vehicules (id)');
        $this->addSql('ALTER TABLE vehicules DROP FOREIGN KEY FK_78218C2D549213EC');
        $this->addSql('ALTER TABLE vehicules ADD CONSTRAINT FK_78218C2D549213EC FOREIGN KEY (property_id) REFERENCES property (id)');
    }
}
