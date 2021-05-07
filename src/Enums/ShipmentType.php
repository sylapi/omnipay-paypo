<?php
declare(strict_types=1);

namespace Omnipay\PayPo\Enums;

class ShipmentType
{
    const COURIER = 0; // kurier (domyślnie)
    const DELIVERYTOPOINT = 1; // dostawa do punktu (np. UPS Access point, DHL Parcel Shop)
    const PACZKOMAT = 2; // paczkomat
    const RUCH = 3; // paczka w RUCHu
    const CLICKCOLLECT = 4; // odbiór w sklepie (click&collect)
}