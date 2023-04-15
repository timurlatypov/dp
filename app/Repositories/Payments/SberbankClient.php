<?php

namespace App\Repositories\Payments;

use Voronkovich\SberbankAcquiring\Client;

class SberbankClient extends Client
{
    protected const PREFIX_DEFAULT = '/payment/rest/';

    /**
     * SberbankClient constructor.
     *
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        parent::__construct($options);
    }

    public function doDeclineOrder($orderId): array
    {
        $data['orderId']       = $orderId;
        $data['merchantLogin'] = config('gateway.sberbank.userName');

        return $this->execute(self::PREFIX_DEFAULT . 'decline.do', $data);
    }
}
