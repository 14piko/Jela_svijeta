<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221026155428 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE food (id INT AUTO_INCREMENT NOT NULL, category INT DEFAULT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_D43829F7989D9B62 (slug), INDEX IDX_D43829F764C19C1 (category), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE food ADD CONSTRAINT FK_D43829F764C19C1 FOREIGN KEY (category) REFERENCES category (id)');
        $this->addSql('ALTER TABLE ingredients ADD food INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ingredients ADD CONSTRAINT FK_4B60114FD43829F7 FOREIGN KEY (food) REFERENCES food (id)');
        $this->addSql('CREATE INDEX IDX_4B60114FD43829F7 ON ingredients (food)');
        $this->addSql('ALTER TABLE tags ADD food INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tags ADD CONSTRAINT FK_6FBC9426D43829F7 FOREIGN KEY (food) REFERENCES food (id)');
        $this->addSql('CREATE INDEX IDX_6FBC9426D43829F7 ON tags (food)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ingredients DROP FOREIGN KEY FK_4B60114FD43829F7');
        $this->addSql('ALTER TABLE tags DROP FOREIGN KEY FK_6FBC9426D43829F7');
        $this->addSql('ALTER TABLE food DROP FOREIGN KEY FK_D43829F764C19C1');
        $this->addSql('DROP TABLE food');
        $this->addSql('DROP INDEX IDX_4B60114FD43829F7 ON ingredients');
        $this->addSql('ALTER TABLE ingredients DROP food');
        $this->addSql('DROP INDEX IDX_6FBC9426D43829F7 ON tags');
        $this->addSql('ALTER TABLE tags DROP food');
    }
}
