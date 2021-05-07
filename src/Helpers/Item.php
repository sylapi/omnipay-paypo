<?php

declare(strict_types=1);

namespace Omnipay\PayPo\Helpers;

use Omnipay\Common;

class Item
{

    public static function toArray(?Common\ItemBag $items, $message = '')
    {
        if($items === null) {
            return [];
        }

        $it = $items->getIterator();

        $fItems = [];

        while( $it->valid() )
        {
            $item = $it->current();
            $fItems[] = [
                'name' => $item->getName(),
                'price' => $item->getPrice(),
                'description' => $item->getDescription(),
                'quantity' => $item->getQuantity()
            ];
            $it->next();
        }

        return $fItems;
    }

    public static function toFlatArray(?Common\ItemBag $items, $message = '')
    {
        if($items === null) {
            return [];
        }
        
        $it = $items->getIterator();

        $fItems = [];

        while( $it->valid() )
        {
            $item = $it->current();
            $fItems[] =self::toString($item, $message);
            $it->next();
        }

        return $fItems;
    }
    
    
    public static function toString(Common\Item $item, $message = '')
    {
        return 'Dodatkowy opis zamówienia, np. zawartość koszyka';
    }
}
