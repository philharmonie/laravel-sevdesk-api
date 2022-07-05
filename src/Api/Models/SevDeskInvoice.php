<?php

namespace Exlo89\LaravelSevdeskApi\Api\Models;

use stdClass;

/**
 *
 */
class SevDeskInvoice extends SevDeskObject
{

    /**
     * The invoice number
     * string or null
     * *required*
     *
     * @var int
     */
    public string $invoiceNumber;

    /**
     * The contact used in the invoice
     * *required*
     *
     * @var object
     */
    public object $contact;

    /**
     * The invoice id
     *
     * @var string
     */
    public int $id;

    /**
     * Needs to be provided as timestamp or dd.mm.yyyy
     * *required*
     *
     * @var string
     */
    public string $invoiceDate;

    /**
     * Normally consist of prefix plus the invoice number
     * string or null
     * Default: null
     *
     * @var string|null
     */
    public ?string $header;

    /**
     * Paypal is allowed
     * 
     * @var bool
     */
    public bool $paypalAllowed = false;

    /**
     * @var string
     */
    public ?string $headText = "<p>Sehr geehrte Damen und Herren,</p><p>ielen Dank für Ihren Auftrag und das damit verbundene Vertrauen!<br>Hiermit stelle ich Ihnen die folgenden Leistungen in Rechnung:</p>";

    /**
     * @var string
     * Initialized in constructor
     */
    public ?string $footText;

    /**
     * @var int
     */
    public int $timeToPay = 14;

    /**
     * @var int|null
     */
    public ?int $discountTime;

    /**
     * @var string
     */
    public string $discount = '0';

    /**
     * @var string|null
     */
    public ?string $payDate;

    /**
     * @var string|null
     */
    public ?string $deliveryDate;

    /**
     * @var int
     */
    public int $status;

    /**
     * @var bool
     */
    public bool $smallSettlement = false;

    /**
     * @var object
     */
    public object $contactPerson;

    /**
     * @var float
     */
    public float $taxRate = 19;

    /**
     * @var string
     */
    public string $taxText = 'Umsatzsteuer 19%';

    /**
     * @var int|null
     */
    public ?int $dunningLevel;

    /**
     * @var string
     */
    public string $taxType = 'default';

    /**
     * @var object|null
     */
    public ?object $paymentMethod;

    /**
     * @var object|null
     */
    public ?object $costCentre;

    /**
     * @var string|null
     */
    public ?string $sendDate;

    /**
     * @var object|null
     */
    public ?object $origin;

    /**
     * Type of the invoice.
     *  Default: "RE"
     *  Enum: "RE" "WKR" "SR" "MA" "TR" "ER"
     *
     * @var string
     */
    public string $invoiceType = "RE";

    /**
     * @var string|null
     */
    public ?string $accountIntervall;

    /**
     * @var int|null
     */
    public ?int $accountNextInvoice;

    /**
     * @var float|null
     */
    public ?float $reminderTotal;

    /**
     * @var float|null
     */
    public ?float $reminderDebit;

    /**
     * @var int|null
     */
    public ?int $reminderDeadline;

    /**
     * @var float|null
     */
    public ?float $reminderCharge;

    /**
     * @var object|null
     */
    public ?object $taxSet;

    /**
     * @var string|null
     */
    public ?string $address;

    /**
     * @var object
     * Initialized in constructor
     */
    public object $addressCountry;

    /**
     * @var string
     */
    public string $currency = "EUR";

    /**
     * @var string|null
     */
    public ?string $customerInternalNote;

    /**
     * @var bool
     */
    public bool $showNet = FALSE;

    /**
     * @var string|null
     */
    public ?string $enshrined;

    /**
     * @var string|null
     */
    public ?string $sendType;

    /**
     * @var string|null
     */
    public ?string $deliveryDateUntil;

    /**
     * @var object|null
     */
    public ?object $datevConnectOnline;

    /**
     * @var string|null
     */
    public ?string $sendPaymentReceivedNotificationDate;

    /**
     * @var string
     */
    public string $mapAll = "true";

    /**
     * @var string
     */
    public string $objectName = "Invoice";

    /**
     * @var float
     */
    public float $paidAmount;

    /**
     * @var float
     */
    public float $sumGross;

    /**
     * @param array $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct();
        $this->invoiceDate = date('d.m.Y');
        $this->contactPerson = env('SEVDESK_CONTACT_PERSON_ID') ? (object) [
            'id' => (int) env('SEVDESK_CONTACT_PERSON_ID'),
            'objectName' => 'SevUser',
        ] : null;
        $this->status = 200;
        $this->addressCountry = (object) [
            'id' => '1',
            'objectName' => 'StaticCountry',
        ];
        $this->footText = "<p>Bitte überweisen Sie den Rechnungsbetrag unter Angabe der Rechnungsnummer auf das unten angegebene Konto" . ($this->paypalAllowed ? " oder per Paypal an " . config('sevdesk-api.paypal_email_address') : "") . ".<br>Der Rechnungsbetrag ist sofort fällig.</p><p>Mit freundlichen Grüßen<br>[%KONTAKTPERSON%]</p>";
        $this->setAttributes($attributes);
    }

    public function getStatusColor()
    {
        switch ($this->status) {
            case 100:
                return 'yellow-400';
            case 200:
                return 'red-400';
            case 1000:
                return 'green-400';
            default:
                return 'gray-400';
        }
    }

    public function getStatusText()
    {
        switch ($this->status) {
            case 100:
                return __('Entwurf');
            case 200:
                return __('Offen');
            case 1000:
                return __('Beazahlt');
            default:
                return __('Unbekannt');
        }
    }

    public function paid()
    {
        return $this->paidAmount == $this->sumGross;
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
