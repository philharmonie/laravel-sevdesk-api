<?php
/*
 * InvoicePos.php
 * @author Martin Appelmann <hello@martin-appelmann.de>
 * @copyright 2022 Martin Appelmann
 */

namespace Exlo89\LaravelSevdeskApi\Api;

use Exlo89\LaravelSevdeskApi\Api\Utils\ApiClient;
use Exlo89\LaravelSevdeskApi\Api\Utils\Routes;

/**
 * Sevdesk Invoice Api
 *
 * @see https://api.sevdesk.de/#tag/InvoicePos
 */
class InvoicePos extends ApiClient
{
    /**
     * Return invoice pos by id.
     *
     * @param int  $invoicePosId
     * @return mixed
     */
    public function getByInvoicePosId($invoicePosId)
    {
        return $this->get(Routes::INVOICEPOS, [
            'id' => $invoicePosId,
        ])[0];
    }
}
