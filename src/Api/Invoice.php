<?php
/*
 * Invoice.php
 * @author Martin Appelmann <hello@martin-appelmann.de>
 * @copyright 2022 Martin Appelmann
 */

namespace Exlo89\LaravelSevdeskApi\Api;

use Exlo89\LaravelSevdeskApi\Api\Models\SevDeskInvoice;
use Exlo89\LaravelSevdeskApi\Api\Models\SevDeskInvoicePos;
use Exlo89\LaravelSevdeskApi\Api\Utils\ApiClient;
use Exlo89\LaravelSevdeskApi\Api\Utils\Routes;

/**
 * Sevdesk Invoice Api
 *
 * @see https://api.sevdesk.de/#tag/Invoice
 */
class Invoice extends ApiClient
{
    /**
     * Invoice status
     */
    const DRAFT = 100;
    const OPEN = 200;
    const PAYED = 1000;

    // =========================== all ====================================

    /**
     * Return all invoices.
     *
     * @return mixed
     */
    public function all()
    {
        return $this->get(Routes::INVOICE);
    }

    /**
     * Return all draft invoices.
     *
     * @return mixed
     */
    public function allDraft()
    {
        return $this->get(Routes::INVOICE, ['status' => self::DRAFT]);
    }

    /**
     * Return all open invoices.
     *
     * @return mixed
     */
    public function allOpen()
    {
        return $this->get(Routes::INVOICE, ['status' => self::OPEN]);
    }

    /**
     * Return all payed invoices.
     *
     * @return mixed
     */
    public function allPayed()
    {
        return $this->get(Routes::INVOICE, ['status' => self::PAYED]);
    }

    /**
     * Return all invoices filtered by contact id.
     *
     * @param int $contactId
     * @return mixed
     */
    public function allByContact($contactId)
    {
        return $this->get(Routes::INVOICE, [
            'contact' => [
                'id' => $contactId,
                'objectName' => 'Contact',
            ],
        ]);
    }

    /**
     * Return all invoices filtered by a date equal or lower.
     *
     * @param int $timestamp
     * @return mixed
     */
    public function allBefore(int $timestamp)
    {
        return $this->get(Routes::INVOICE, ['endDate' => $timestamp]);
    }

    /**
     * Return all invoices filtered by a date equal or higher.
     *
     * @param int $timestamp
     * @return mixed
     */
    public function allAfter(int $timestamp)
    {
        return $this->get(Routes::INVOICE, ['startDate' => $timestamp]);
    }

    /**
     * Return all invoices filtered by a date equal or higher.
     *
     * @param int $invoiceId
     * @return mixed
     */
    public function pdf(int $invoiceId)
    {
        return $this->get(Routes::INVOICE . '/' . $invoiceId . '/getPdf');
    }

    /**
     * Create invoice
     * @param SevDeskInvoice $invoice
     * @param SevDeskInvoicePos[] $positions
     * @return mixed
     */
    public function create(SevDeskInvoice $invoice, array $positions)
    {
        $parameters = [
            'invoice' => $invoice,
            'invoicePosSave' => $positions,
            'invoicePosDelete' => null,
            'discountSave' => null,
            'discountDelete' => null,
            'takeDefaultAddress' => true,
        ];

        return $this->post(Routes::SAVE_INVOICE, $parameters);
    }
}
