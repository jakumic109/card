<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200322224729 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("CREATE TABLE `file` (
                                `id` INT(11) NOT NULL AUTO_INCREMENT,
                                `fileName` VARCHAR(255) NOT NULL COLLATE 'utf8mb4_unicode_ci',
                                `fileContent` LONGTEXT NOT NULL COLLATE 'utf8mb4_unicode_ci',
                                PRIMARY KEY (`id`)
                        )
                        COLLATE='utf8mb4_unicode_ci'
                        ENGINE=InnoDB;");
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql("drop table `file`");
    }
}
