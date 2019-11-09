<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190915012903 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up() : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE mobile (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, screen VARCHAR(255) NOT NULL, design VARCHAR(255) NOT NULL, colour VARCHAR(255) NOT NULL, android VARCHAR(255) NOT NULL, processor VARCHAR(255) NOT NULL, ram VARCHAR(255) NOT NULL, camera VARCHAR(255) NOT NULL, storage VARCHAR(255) NOT NULL, drums VARCHAR(255) NOT NULL, sim_card VARCHAR(255) NOT NULL, compatibility VARCHAR(255) NOT NULL, sav VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down() : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE mobile');
    }
}
