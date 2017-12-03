<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171203143620 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE occasion (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE wish_list (id INT AUTO_INCREMENT NOT NULL, occasion_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_5B8739BD4034998F (occasion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, link LONGTEXT DEFAULT NULL, itemType_id INT DEFAULT NULL, wishList_id INT DEFAULT NULL, INDEX IDX_1F1B251E753B2743 (itemType_id), INDEX IDX_1F1B251E34336D51 (wishList_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE wish_list ADD CONSTRAINT FK_5B8739BD4034998F FOREIGN KEY (occasion_id) REFERENCES occasion (id)');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251E753B2743 FOREIGN KEY (itemType_id) REFERENCES item_type (id)');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251E34336D51 FOREIGN KEY (wishList_id) REFERENCES wish_list (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE wish_list DROP FOREIGN KEY FK_5B8739BD4034998F');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251E34336D51');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251E753B2743');
        $this->addSql('DROP TABLE occasion');
        $this->addSql('DROP TABLE wish_list');
        $this->addSql('DROP TABLE item');
        $this->addSql('DROP TABLE item_type');
    }
}
