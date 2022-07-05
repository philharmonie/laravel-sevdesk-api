<?php

namespace Exlo89\LaravelSevdeskApi\Api\Models;


/**
 *
 */
class SevDeskPart extends SevDeskObject
{

    /**
     * The part number
     *
     * @var string
     */
    public string $name;

    /**
     * The part number
     *
     * @var string
     */
    public string $partNumber;

    /**
     * A text describing the part
     * 
     * @var string|null
     */
    public ?string $text = null;

    /**
     * Category of the part.
     * For all categories, send a GET to /Category?objectType=Part
     *
     * @var object|null
     */
    public ?object $partDate;

    /**
     * The stock of the part
     *
     * @var float
     */
    public float $stock = 0;

    /**
     * Defines if the stock should be enabled
     * 
     * @var bool
     */
    public bool $stockEnabled = true;

    /**
     * The unit in which the part is measured
     * 
     * @var object
     */
    public object $unity;

    /**
     * Net price for which the part is sold. we will change this parameter so that the gross price is calculated automatically, until then the priceGross parameter must be used
     * @var float|null
     */
    public ?float $price = null;

    /**
     * Net price for which the part is sold
     * 
     * @var float|null
     */
    public ?float $priceNet = null;

    /**
     * Gross price for which the part is sold
     * 
     * @var float|null
     */
    public ?float $priceGross = null;

    /**
     * Purchase price of the part
     * 
     * @var float|null
     */
    public ?float $pricePurchase = null;

    /**
     * Tax rate of the part
     * 
     * @var float
     */
    public float $taxRate = 19;

    /**
     * Default: 100
     * Enum: 50 100
     * Status of the part. 50 <-> Inactive - 100 <-> Active
     * 
     * @var int|null
     */
    public ?int $status = 100;

    /**
     * An internal comment for the part
     * Does not appear on invoices and orders.
     * 
     * @var int|null
     */
    public ?int $internalComment = null;

    /**
     * @param array $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct();
        $this->unity = (object) [
            'id' => '1',
            'objectName' => 'Unity',
        ];
        $this->setAttributes($attributes);
    }


    private function setAttributes(array $attributes)
    {
        foreach ($attributes as $key => $value) {
            if (property_exists($this, $key)) {
                if (is_array($value)) {
                    $value = (object) $value;
                }
                $this->{$key} = $value;
            }
        }
    }
}
