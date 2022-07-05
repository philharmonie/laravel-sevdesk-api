<?php

namespace Exlo89\LaravelSevdeskApi\Api\Models;

class SevDeskInvoicePos extends SevDeskObject
{

    /**
     * @var object|null
     */
    public ?object $part;

    /**
     * @var float|null
     */
    public ?float $quantity;

    /**
     * @var float|null
     */
    public ?float $price;

    /**
     * @var string|null
     */
    public ?string $name;

    /**
     * @var object|null
     */
    public ?object $unity;

    /**
     * @var int|null
     */
    public ?int $positionNumber;

    /**
     * @var string|null
     */
    public ?string $text;

    /**
     * @var float|null
     */
    public ?float $discount;

    /**
     * @var float|null
     */
    public ?float $taxRate = 19;

    /**
     * @var float|null
     */
    public ?float $priceGross;

    /**
     * @var float|null
     */
    public ?float $priceTax;

    /**
     * @var string
     */
    public string $mapAll = "true";

    /**
     * @var string
     */
    public string $objectName = "InvoicePos";

    /**
     *
     */
    public function __construct()
    {
        parent::__construct();
    }
}
