<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191209082222 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDE20531EB8');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDE20531EB8 FOREIGN KEY (multimedia_id) REFERENCES multimedia (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE multimedia DROP FOREIGN KEY FK_61312863549213EC');
        $this->addSql('ALTER TABLE multimedia ADD CONSTRAINT FK_61312863549213EC FOREIGN KEY (property_id) REFERENCES property (id) ON DELETE SET NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE multimedia DROP FOREIGN KEY FK_61312863549213EC');
        $this->addSql('ALTER TABLE multimedia ADD CONSTRAINT FK_61312863549213EC FOREIGN KEY (property_id) REFERENCES property (id)');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDE20531EB8');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDE20531EB8 FOREIGN KEY (multimedia_id) REFERENCES multimedia (id)');
    }
}
