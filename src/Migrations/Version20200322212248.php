<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200322212248 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->add("INSERT INTO `user` VALUES (NULL,'guest','[\"ROLE_UR\"]','\$2y$12\$jzeRuJv4VjPIShKDXnMSiukNAZmk643xiTYz./C4Bli1tMfID.t42')");
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->add("TRUNCATE TABLE `user`");
    }
}
