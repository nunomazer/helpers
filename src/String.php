<?php 

namespace Winponta\Helpers;

class String {
	protected $string = '';

	/**
	* Construct with the default string to be used with the class functions
	**/
	public function __construct($string = '') {
		$this->string = $string;
	}
	
	public function transliterate($string = '') {
		$string = $string <> '' ? $string : $this->string;	

		//$string = mb_convert_case($string, MB_CASE_UPPER, "UTF-8");		
		$string = transliterator_transliterate('Any-Latin; Latin-ASCII; [\u0100-\u7fff] remove', $string);

		$string = trim($string);

		// TODO verify if we should remove -
		//$string = str_replace('-','',$string);

		return $string;
	}

	/**
	* Based on http://php.net/manual/en/function.ucwords.php comments of antoniomax at antoniomax dot com
	**/
	public function ucwords($string = '', 
			$delimiters = array(" ", "-", ".", "'", "O'", "Mc"), 
			$exceptions = array("de", "da", "dos", "das", "do", "I", "II", "III", "IV", "V", "VI")
	) {
		$string = $string <> '' ? $string : $this->string;

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
}
