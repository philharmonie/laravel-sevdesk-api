<?php
/*
 * ContactAddress.php
 * @author Martin Appelmann <hello@martin-appelmann.de>
 * @copyright 2021 Martin Appelmann
 */

namespace Exlo89\LaravelSevdeskApi\Api;

use Exlo89\LaravelSevdeskApi\Api\Utils\ApiClient;
use Exlo89\LaravelSevdeskApi\Api\Utils\Routes;

/**
 * Sevdesk Contact Address Api
 *
 * @see https://api.sevdesk.de/#tag/ContactAddress
 */
class ContactAddress extends ApiClient
{
    /**
     * Create contact address.
     *
     * @param int $contactId
     * @param array $parameters
     * @return mixed
     */
    public function create(int $contactId, array $parameters = [])
    {
        $parameters['contact'] = [
            "id" => $contactId,
            "objectName" => "Contact",
        ];
        $parameters['country'] = [
            "id" => $this->getCountryCode($parameters['country']),
            "objectName" => "StaticCountry",
        ];
        return $this->post(Routes::CONTACT_ADDRESS, $parameters);
    }

    /**
     * Get Country Code
     *
     * @param string $code
     * @return int
     */
    private function getCountryCode($code)
    {
        switch ($code) {
            case 'A':
                return 43;
            case 'B':
                return 32;
            case 'CH':
                return 41;
            case 'CZ':
                return 420;
            case 'D':
                return 1;
            case 'F':
                return 33;
            case 'I':
                return 39;
            case 'L':
                return 370;
            case 'RO':
                return 40;
            case 'VN':
                return 84;

            default:
                return 1;
        }
    }
}
