<?php

namespace inc\v1\content;

use DB\UserAdresses;

class Content
{
    public static function addressStringBuilder(UserAdresses $address): string
    {
        $text = "{$address->getZipCode()},
                            {$address->getRegion()},
                             г. {$address->getCity()},
                              ул. {$address->getStreet()},
                               д. {$address->getHouse()}";
        if (empty($address->getApartment())) {
            return $text;
        }

        return $text . ", кв. {$address->getApartment()}";
    }
}