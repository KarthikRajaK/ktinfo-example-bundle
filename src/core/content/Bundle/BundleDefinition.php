<?php declare(strict_types=1);

namespace Ktinfo\ExampleBundle\Core\Content\Bundle;

use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FloatField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\StringField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class BundleDefinition extends EntityDefinition {

    public const ENTITY_NAME = 'ktinfo_bundle';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    public function getEntityClass(): string
    {
        return BundleEntity::class;
    }

    protected function defineFields(): FieldCollection 
    {
        return new FieldCollection([
            (new IdField('id', 'id'))->addFlags(new Required(), new PrimaryKey()),
            (new StringField('discount_type', 'discountType'))->addFlags(new Required()),
            (new FloatField('discount', 'discount'))->addFlags(new Required()),
        ]);
    }

}