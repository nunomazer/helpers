# helpers

PHP common lib with several class helpers

## Usage

### ArrayHelper

#### charsetConvertToUTF8

Function to convert all values of an array to charset UTF-8

#### charsetConvert

Function to convert all values of an array from one charset to another

#### verifyKeysSet

Check if a key or array of keys exists in an array

#### verifyKeysSet

Check if a key exist in a simple or multidimensional array

### StringHelper

#### ucwords

Function that mimics original php ucwords, but works with exceptions and delimiters to not upper case words like (in Portuguese):

de, da, do, o, a, os .. etc.

    $s = StringHelper::ucwords('JOÃO DA SILVA');
    echo $s;
    // output
    // João da Silva

#### transliterate

Function that simplify the String transliterating accents.

Depends on 'php-intl' extension
