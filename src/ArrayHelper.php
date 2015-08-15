<?php

/**
 * Array utils
 *
 * @author Ademir Mazer Jr <ademir.mazer.jr@gmail.com>
 * 
 */

namespace Winponta\Helpers;

class ArrayHelper {

    /**
     * Convert array from ISO-8859-1, or another charset,
     * to UTF-8
     * 
     * @param array $array
     * @return array
     */
    static public function charsetConvertToUTF8($array, $from = 'ISO-8859-1') {
        return self::charsetConvert($array, $from, 'UTF-8');
    }

    /**
     * Recursive convertion of charsets in an array
     * 
     * @param array $array
     * @return array
     */
    static public function charsetConvert($array, $from, $to) {
        if (is_array($array)) {
            foreach ($array as $key => $value) {
                if (is_array($value)) {
                    $array[$key] = self::charsetConvert($value, $from, $to);
                } else {
                    $array[$key] = StringHelper::charsetConvert($value, $from, $to);
                }
            }
        }

        return $array;
    }

    /**
     * Check if a key or array of keys exists in an array
     * 
     * @param array|string $keySearch - key or array of keys to be found
     * @param array $array - array to search in
     * @param boolean $matchAll - set if all keys must match, if false, 
     *                              when one of the keys is found returns true
     * 
     * @return boolean
     */
    static public function verifyKeysSet($keySearch, $array, $matchAll = true) {
        if (is_array($keySearch)) {
            if (empty($keySearch)) {
                return false;
            }

            $allExist = $matchAll;
            if ($matchAll) {
                foreach ($keySearch as $key) {
                    // Se deve encontrar todas as chaves, quando uma não for encontrada já retorna false
                    if (self::verifyKey($key, $array) !== true) {
                        return false;
                    }
                }

                // se percorreu todas as chaves e chegou neste ponto, todas foram encontradas
                return true;
            } else {
                foreach ($keySearch as $key) {
                    // se não precisa encontrar todas, a primeira que encontrar retorna true
                    if (self::verifyKey($key, $array)) {
                        return true;
                    }
                }

                // se percorreu todas as chaves e chegou neste ponto, NENHUMA foi encontrada
                return false;
            }
        } else {
            // não é um array então verifica somente para a string
            return self::verifyKey($keySearch, $array);
        }
    }

    /**
     * Check if a key exist in a simple or multidimensional array
     * 
     * @param string $keySearch - key to be found
     * @param array $array - array to search in
     * @return boolean
     */
    static public function verifyKey($keySearch, $array) {
        // check if it's even an array
        if (!is_array($array)) {
            return false;
        }

        // key exists
        if (array_key_exists($keySearch, $array)) {
            return true;
        }

        // key isn't in this array, go deeper
        foreach ($array as $key => $val) {
            // return true if it's found
            if (self::verifyKey($keySearch, $val)) {
                return true;
            }
        }

        return false;
    }

}
