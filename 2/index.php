<?php

function findNumbersRepeatOdd(string $str): array
{
    $numberCount = array_count_values(str_split($str));
    $repeatOdd = array_filter($numberCount, function ($count) {
        return $count & 1;
    });

    return array_keys($repeatOdd);
}

echo implode(', ', findNumbersRepeatOdd('121303948'));
