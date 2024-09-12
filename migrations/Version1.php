<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Model\Message;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version1 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create customer table and populate testing placeholders.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            <<<'SQL'
CREATE TABLE customer
(
    id INT UNSIGNED AUTO_INCREMENT NOT NULL,
    `customer_code` VARCHAR(32) NOT NULL,
    `notification_type` VARCHAR(32) NOT NULL,
     PRIMARY KEY(id)
) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
SQL
        );

        $this->addSql(
            <<<SQL
INSERT INTO customer
(customer_code, notification_type)
VALUES
('code-sms', :type_sms),
('code-email', :type_email)
SQL
            ,
            [
                'type_sms' => Message::TYPE_SMS,
                'type_email' => Message::TYPE_EMAIL,
            ]
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE customer');
    }
}
