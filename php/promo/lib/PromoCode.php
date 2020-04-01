<?php

namespace promo;

use Exception;

/**
 * Converting int user id to string promo code and back
 *
 * @package promo
 */
class PromoCode
{
    private $prefix = "REF";

    /**
     * @param int $id
     * @return string
     */
    public function codeById($id)
    {
        $promoCode = $this->prefix . dechex($id);
        return strtoupper($promoCode);
    }

    /**
     * @param string $promoCode
     * @return float|int
     * @throws Exception
     */
    public function idByCode($promoCode)
    {
        if (strpos($promoCode, $this->prefix) === false) {
            throw new Exception('Wrong promo code');
        }
        $hexId = str_replace($this->prefix, '', $promoCode);

        return hexdec($hexId);
    }
}