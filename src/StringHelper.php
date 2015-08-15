<?php

namespace Winponta\Helpers;

class StringHelper {
    public static function transliterate($string, $options = ['UPPER']) {
        $op = '';
        if (array_key_exists('UPPER', $options) || in_array('UPPER', $options)) {
            $op = '; Upper()';
        }
        if (array_key_exists('LOWER', $options) || in_array('LOWER', $options)) {
            $op = '; Lower()';
        }

        //$string = mb_convert_case($string, MB_CASE_UPPER, "UTF-8");		
        $string = transliterator_transliterate('Any-Latin; Latin-ASCII; [\u0100-\u7fff] remove' . $op, $string);

        $string = trim($string);

        // TODO verify if we should remove -
        //$string = str_replace('-','',$string);

        return $string;
    }

    /**
     * Based on http://php.net/manual/en/function.ucwords.php comments of antoniomax at antoniomax dot com
     * */
    public static function ucwords($string, $delimiters = array(" ", "-", ".", "'", "O'", "Mc"), $exceptions = array("de", "da", "dos", "das", "do", "I", "II", "III", "IV", "V", "VI")
    ) {
        /*
         * Exceptions in lower case are words you don't want converted
         * Exceptions all in upper case are any words you don't want converted to title case
         *   but should be converted to upper case, e.g.:
         *   king henry viii or king henry Viii should be King Henry VIII
         */
        $string = mb_convert_case($string, MB_CASE_TITLE, "UTF-8");
        foreach ($delimiters as $dlnr => $delimiter) {
            $words = explode($delimiter, $string);
            $newwords = array();
            foreach ($words as $wordnr => $word) {
                if (in_array(mb_strtoupper($word, "UTF-8"), $exceptions)) {
                    // check exceptions list for any words that should be in upper case
                    $word = mb_strtoupper($word, "UTF-8");
                } elseif (in_array(mb_strtolower($word, "UTF-8"), $exceptions)) {
                    // check exceptions list for any words that should be in upper case
                    $word = mb_strtolower($word, "UTF-8");
                } elseif (!in_array($word, $exceptions)) {
                    // convert to uppercase (non-utf8 only)
                    $word = ucfirst($word);
                }
                array_push($newwords, $word);
            }
            $string = join($delimiter, $newwords);
        }//foreach
        return $string;
    }

    public static function charsetConvert($string, $from, $to) {
        if (mb_detect_encoding($string, $from, true) != $from) {
            $string = mb_convert_encoding($value, $to, $from);
        }
        
        return $string;
    }
    
    public static function charsetConvertToUTF8($string, $from) {
        return String::charsetConvert($string, $from, 'UTF-8');
    }

}
