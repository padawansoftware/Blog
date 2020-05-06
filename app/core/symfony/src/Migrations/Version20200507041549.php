<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200507041549 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Initial database schema';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE Asset (asset_id INT AUTO_INCREMENT NOT NULL, asset_name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, asset_updated_at DATE NOT NULL, PRIMARY KEY(asset_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE Chapter (id INT AUTO_INCREMENT NOT NULL, chapter_post INT DEFAULT NULL, chapter_content LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, chapter_enabled TINYINT(1) NOT NULL, chapter_title VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_363C8CB2767B1818 (chapter_post), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE Collection (collection_id INT AUTO_INCREMENT NOT NULL, collection_image INT DEFAULT NULL, collection_name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, post_slug VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, UNIQUE INDEX UNIQ_B31066E282C5BC0C (collection_image), PRIMARY KEY(collection_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE Collection_Post (collection_id INT NOT NULL, post_id INT NOT NULL, INDEX IDX_380AD1C34B89032C (post_id), INDEX IDX_380AD1C3514956FD (collection_id), PRIMARY KEY(collection_id, post_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE Page (page_id INT AUTO_INCREMENT NOT NULL, page_content LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, page_enabled TINYINT(1) NOT NULL, page_slug VARCHAR(64) NOT NULL COLLATE utf8mb4_unicode_ci, page_name VARCHAR(64) NOT NULL COLLATE utf8mb4_unicode_ci, UNIQUE INDEX UNIQ_B438191E1F5987B8 (page_slug), PRIMARY KEY(page_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE Post (post_id INT AUTO_INCREMENT NOT NULL, post_image INT DEFAULT NULL, post_title VARCHAR(128) NOT NULL COLLATE utf8mb4_unicode_ci, createdAt DATETIME NOT NULL, post_enabled TINYINT(1) DEFAULT \'0\' NOT NULL, post_slug VARCHAR(128) NOT NULL COLLATE utf8mb4_unicode_ci, post_order INT NOT NULL, UNIQUE INDEX UNIQ_FAB8C3B3522688B0 (post_image), UNIQUE INDEX slug (post_slug), PRIMARY KEY(post_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE User (user_id INT AUTO_INCREMENT NOT NULL, user_username VARCHAR(180) NOT NULL COLLATE utf8mb4_unicode_ci, user_roles LONGTEXT NOT NULL COLLATE utf8mb4_bin, user_password VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, UNIQUE INDEX UNIQ_2DA1797718D3E277 (user_username), PRIMARY KEY(user_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE Asset');
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE Chapter');
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE Collection');
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE Collection_Post');
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE Page');
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE Post');
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE User');
    }
}
