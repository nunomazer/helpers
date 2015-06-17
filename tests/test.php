<?php

require '../src/String.php';

$s = new Winponta\Helpers\String('A æ Übérmensch på høyeste nivå! И я люблю PHP! есть. ﬁ');

echo $s->transliterate();