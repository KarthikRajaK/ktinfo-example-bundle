<?php declare(strict_types=1);

namespace Ktinfo\ExampleBundle\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\InheritanceUpdaterTrait;
use Shopware\Core\Framework\Migration\MigrationStep;

class Migration1591772822Bundle extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1591772822;
    }

    public function update(Connection $connection): void
    {
        $connection->executeUpdate('
            CREATE TABLE IF NOT EXISTS `ktinfo_bundle` (
              `id` BINARY(16) NOT NULL,
              `discount_type` VARCHAR(255) NOT NULL,
              `discount` DOUBLE NOT NULL,
              `created_at` DATETIME(3) NOT NULL,
              `updated_at` DATETIME(3) NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ');

        $connection->executeUpdate('
            CREATE TABLE IF NOT EXISTS `ktinfo_bundle_product` (
              `bundle_id` BINARY(16) NOT NULL,
              `product_id` BINARY(16) NOT NULL,
              `product_version_id` BINARY(16) NOT NULL,
              `created_at` DATETIME(3) NOT NULL,
              PRIMARY KEY (`bundle_id`, `product_id`, `product_version_id`),
              CONSTRAINT `fk.bundle_product.bundle_id` FOREIGN KEY (`bundle_id`)
                REFERENCES `ktinfo_bundle` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `fk.bundle_product.product_id__product_version_id` FOREIGN KEY (`product_id`, `product_version_id`)
                REFERENCES `product` (`id`, `version_id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ');

        $connection->executeUpdate('
            CREATE TABLE IF NOT EXISTS `ktinfo_bundle_translation` (
              `ktinfo_bundle_id` BINARY(16) NOT NULL,
              `language_id` BINARY(16) NOT NULL,
              `name` VARCHAR(255),
              `created_at` DATETIME(3) NOT NULL,
              `updated_at` DATETIME(3) NULL,
              PRIMARY KEY (`ktinfo_bundle_id`, `language_id`),
              CONSTRAINT `fk.bundle_translation.bundle_id` FOREIGN KEY (`ktinfo_bundle_id`)
                REFERENCES `ktinfo_bundle` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `fk.bundle_translation.language_id` FOREIGN KEY (`language_id`)
                REFERENCES `language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ');

        $this->updateInheritance($connection, 'product', 'bundles');
    }

    public function updateDestructive(Connection $connection): void
    {
        // implement update destructive
    }
}
