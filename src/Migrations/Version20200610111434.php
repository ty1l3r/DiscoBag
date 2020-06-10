<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200610111434 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, social_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(100) NOT NULL, last_name VARCHAR(100) NOT NULL, dj_name VARCHAR(100) DEFAULT NULL, crew VARCHAR(100) DEFAULT NULL, genre VARCHAR(10) NOT NULL, avatar VARCHAR(255) DEFAULT NULL, birth DATE NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D649FFEB5B27 (social_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE track (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(180) NOT NULL, length TIME NOT NULL, face VARCHAR(10) NOT NULL, tone VARCHAR(20) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE track_artist (track_id INT NOT NULL, artist_id INT NOT NULL, INDEX IDX_499B576E5ED23C43 (track_id), INDEX IDX_499B576EB7970CF8 (artist_id), PRIMARY KEY(track_id, artist_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `set` (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, set_name VARCHAR(100) NOT NULL, mix_com LONGTEXT DEFAULT NULL, set_com LONGTEXT DEFAULT NULL, INDEX IDX_E61425DCA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artist (id INT AUTO_INCREMENT NOT NULL, pseudo VARCHAR(100) NOT NULL, country VARCHAR(100) NOT NULL, crew VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE disk (id INT AUTO_INCREMENT NOT NULL, disk_title VARCHAR(100) NOT NULL, year DATE NOT NULL, label VARCHAR(100) NOT NULL, artwork VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE disk_artist (disk_id INT NOT NULL, artist_id INT NOT NULL, INDEX IDX_87D1966B63B1F25 (disk_id), INDEX IDX_87D1966BB7970CF8 (artist_id), PRIMARY KEY(disk_id, artist_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE disk_track (disk_id INT NOT NULL, track_id INT NOT NULL, INDEX IDX_8D31C07663B1F25 (disk_id), INDEX IDX_8D31C0765ED23C43 (track_id), PRIMARY KEY(disk_id, track_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE social (id INT AUTO_INCREMENT NOT NULL, insta VARCHAR(255) DEFAULT NULL, fb VARCHAR(255) DEFAULT NULL, youtube VARCHAR(255) DEFAULT NULL, deezer VARCHAR(255) DEFAULT NULL, twitter VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649FFEB5B27 FOREIGN KEY (social_id) REFERENCES social (id)');
        $this->addSql('ALTER TABLE track_artist ADD CONSTRAINT FK_499B576E5ED23C43 FOREIGN KEY (track_id) REFERENCES track (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE track_artist ADD CONSTRAINT FK_499B576EB7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `set` ADD CONSTRAINT FK_E61425DCA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE disk_artist ADD CONSTRAINT FK_87D1966B63B1F25 FOREIGN KEY (disk_id) REFERENCES disk (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE disk_artist ADD CONSTRAINT FK_87D1966BB7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE disk_track ADD CONSTRAINT FK_8D31C07663B1F25 FOREIGN KEY (disk_id) REFERENCES disk (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE disk_track ADD CONSTRAINT FK_8D31C0765ED23C43 FOREIGN KEY (track_id) REFERENCES track (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE `set` DROP FOREIGN KEY FK_E61425DCA76ED395');
        $this->addSql('ALTER TABLE track_artist DROP FOREIGN KEY FK_499B576E5ED23C43');
        $this->addSql('ALTER TABLE disk_track DROP FOREIGN KEY FK_8D31C0765ED23C43');
        $this->addSql('ALTER TABLE track_artist DROP FOREIGN KEY FK_499B576EB7970CF8');
        $this->addSql('ALTER TABLE disk_artist DROP FOREIGN KEY FK_87D1966BB7970CF8');
        $this->addSql('ALTER TABLE disk_artist DROP FOREIGN KEY FK_87D1966B63B1F25');
        $this->addSql('ALTER TABLE disk_track DROP FOREIGN KEY FK_8D31C07663B1F25');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649FFEB5B27');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE track');
        $this->addSql('DROP TABLE track_artist');
        $this->addSql('DROP TABLE `set`');
        $this->addSql('DROP TABLE artist');
        $this->addSql('DROP TABLE disk');
        $this->addSql('DROP TABLE disk_artist');
        $this->addSql('DROP TABLE disk_track');
        $this->addSql('DROP TABLE social');
    }
}
