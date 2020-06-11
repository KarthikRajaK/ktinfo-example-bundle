<?php declare(strict_types=1);

namespace Ktinfo\ExampleBundle\Core\Content\Bundle;

use Shopware\Core\Content\Product\ProductDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FloatField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\StringField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\Framework\DataAbstractionLayer\Field\TranslatedField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\TranslationsAssociationField;
use Ktinfo\ExampleBundle\Core\Content\Bundle\Aggregate\BundleProduct\BundleProductDefinition;

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

    public function getCollectionClass(): string
    {
        return BundleCollection::class;
    }

    protected function defineFields(): FieldCollection 
    {
        return new FieldCollection([
            (new IdField('id', 'id'))->addFlags(new Required(), new PrimaryKey()),
            new TranslatedField('name'),
            (new StringField('discount_type', 'discountType'))->addFlags(new Required()),
            (new FloatField('discount', 'discount'))->addFlags(new Required()),
            new TranslationsAssociationField(BundleTranslationDefinition::class, 'ktinfo_bundle_id'),
            new ManyToManyAssociationField('products', ProductDefinition::class, BundleProductDefinition::class, 'bundle_id', 'product_id')
        ]);
    }

}