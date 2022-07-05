<?php
/*
 * Contact.php
 * @author Martin Appelmann <hello@martin-appelmann.de>
 * @copyright 2021 Martin Appelmann
 */

namespace Exlo89\LaravelSevdeskApi\Api;

use Exlo89\LaravelSevdeskApi\Api\Models\SevDeskPart;
use Exlo89\LaravelSevdeskApi\Api\Utils\ApiClient;
use Exlo89\LaravelSevdeskApi\Api\Utils\Routes;

/**
 * Sevdesk Part Api
 *
 * @see https://api.sevdesk.de/#tag/Part
 */
class Part extends ApiClient
{
    // =========================== all ====================================

    /**
     * Retrieve all parts in your sevDesk inventory according to the applied filters.
     *
     * @return mixed
     */
    public function all()
    {
        return $this->get(Routes::PART);
    }

    // =========================== get ====================================


    /**
     * Returns a single part
     *
     * @param int $id
     * @return mixed
     */
    public function byId(int $id)
    {
        return $this->get(Routes::PART, ['id' => $id]);
    }

    // ========================== create ==================================

    /**
     * Creates a part in your sevDesk inventory.
     *
     * @param array $part
     * @return mixed
     */
    public function create(array $part)
    {
        return $this->post(Routes::PART, $part);
    }
}
