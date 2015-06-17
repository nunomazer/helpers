# helpers

PHP common lib with several class helpers

## Usage

### String class

#### ucwords

Function that mimics original php ucwords, but works with exceptions and delimiters to not upper case words like (in Portuguese):

de, da, do, o, a, os .. etc.

#### transliterate

Function that simplify the String transliterating accents.

Depends on 'php-intl' extension
