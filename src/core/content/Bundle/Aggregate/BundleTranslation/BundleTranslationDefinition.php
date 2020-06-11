<?php declare(strict_types=1);

namespace Ktinfo\ExampleBundle\Core\Content\Bundle\Aggregate\BundleTranslation;

use Shopware\Core\Framework\DataAbstractionLayer\EntityTranslationDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\StringField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Ktinfo\ExampleBundle\Core\Content\Bundle\BundleDefinition;

class BundleTranslationDefinition extends EntityTranslationDefinition
{
    public function getEntityName(): string
    {
        return 'ktinfo_bundle_translation';
    }

    public function getCollectionClass(): string
    {
        return BundleTranslationCollection:: class;
    }

    public function getEntityClass(): string
    {
        return BundleTranslationEntity::class;
    }

    public function getParentDefinitionClass(): string
    {
        return BundleDefinition::class;
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new StringField('name', 'name'))->addFlags(new Required()),
        ]);
    }
}