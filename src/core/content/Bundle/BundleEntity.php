<?php declare(strict_types=1);

namespace Ktinfo\ExampleBundle\Core\Content\Bundle;

use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;

class BundleEntity extends Entity
{
    use EntityIdTrait;

    /**
     * @var string
     */
    protected $discountType;

    /**
     * @var float
     */
    protected $discount;

    public function getDiscountType(): string 
    {
        return $this->discountType;
    }

    public function setDiscountType(string $discountType): void
    {
        $this->discountType = $discountType;
    }

    public function getDiscount(): string
    {
        return $this->discount;
    }

    public function setDiscount(float $discount): void
    {
        $this->discount = $discount;
    }
}