<?php
declare(strict_types=1);

namespace Omnipay\PayPo\Enums;

class StatusType
{
    const NEW = 'NEW'; // Nowa transakcja
    const PENDING = 'PENDING'; // Płatność w trakcie procesowania, oczekuje na potwierdzenie tożsamości Kupującego lub potwierdzenie dostępności środków
    const ACCEPTED = 'ACCEPTED'; // Płatność zaakceptowana
    const COMPLETED = 'COMPLETED'; // Transakcja potwierdzona przez Sprzedawcę, płatność gotowa do rozliczenia
    const REJECTED = 'REJECTED'; // Odmowa realizacji płatności
    const CANCELED = 'CANCELED'; // Transakcja anulowana
}