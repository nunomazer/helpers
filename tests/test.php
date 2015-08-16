<?php

require '../src/StringHelper.php';
require '../src/ArrayHelper.php';
require '../vendor/neitanod/forceutf8/src/ForceUTF8/Encoding.php';

$s = Winponta\Helpers\StringHelper::transliterate('A æ Übérmensch på høyeste nivå! И я люблю PHP! есть. ﬁ');

echo $s;

echo PHP_EOL;

$array = [
        'data'=>"14/07/2015",
        'hora'=>"14:24:28",
        'ano'=>"2012",
        'eleicao'=>"ELEI��O MUNICIPAL 2012",
        'estado'=>"PR",
        'cod'=>"76139",
        'cidade'=>"ITAMBARAC�",
        'num'=>"11",
        'cargo'=>"PREFEITO",
        'qtde'=>"1"
];

$a = Winponta\Helpers\ArrayHelper::forceUTF8($array);


var_dump($a);