<?php

namespace App\Services;

class NumberToFrenchWords
{
    private const UNITS = [
        'zéro', 'un', 'deux', 'trois', 'quatre', 'cinq', 'six', 'sept', 'huit', 'neuf',
        'dix', 'onze', 'douze', 'treize', 'quatorze', 'quinze', 'seize', 'dix-sept', 'dix-huit', 'dix-neuf',
    ];

    private const TENS = [2 => 'vingt', 3 => 'trente', 4 => 'quarante', 5 => 'cinquante', 6 => 'soixante'];

    public static function convert(float $amount): string
    {
        $amount      = round($amount, 2);
        $integerPart = (int) floor($amount);
        $decimalPart = (int) round(($amount - $integerPart) * 100);

        $words = self::convertInteger($integerPart);

        if ($decimalPart > 0) {
            $words .= ' et ' . self::convertInteger($decimalPart) . ' centime' . ($decimalPart > 1 ? 's' : '');
        }

        return $words;
    }

    private static function convertInteger(int $number): string
    {
        if ($number === 0) {
            return 'zéro';
        }
        if ($number < 0) {
            return 'moins ' . self::convertInteger(-$number);
        }

        $parts = [];

        if ($number >= 1_000_000_000) {
            $n       = intdiv($number, 1_000_000_000);
            $parts[] = $n === 1 ? 'un milliard' : self::convertUnder1000($n) . ' milliards';
            $number %= 1_000_000_000;
        }
        if ($number >= 1_000_000) {
            $n       = intdiv($number, 1_000_000);
            $parts[] = $n === 1 ? 'un million' : self::convertUnder1000($n) . ' millions';
            $number %= 1_000_000;
        }
        if ($number >= 1000) {
            $n       = intdiv($number, 1000);
            $parts[] = $n === 1 ? 'mille' : self::convertUnder1000($n) . ' mille';
            $number %= 1000;
        }
        if ($number > 0) {
            $parts[] = self::convertUnder1000($number);
        }

        return implode(' ', $parts);
    }

    private static function convertUnder1000(int $number): string
    {
        if ($number < 20) {
            return self::UNITS[$number];
        }
        if ($number < 100) {
            return self::convertTens($number);
        }

        $hundreds = intdiv($number, 100);
        $rest     = $number % 100;

        $str = $hundreds === 1 ? 'cent' : self::UNITS[$hundreds] . ' cent';

        if ($rest === 0) {
            if ($hundreds > 1) {
                $str .= 's';
            }
        } else {
            $str .= ' ' . self::convertTens($rest);
        }

        return $str;
    }

    private static function convertTens(int $number): string
    {
        if ($number < 20) {
            return self::UNITS[$number];
        }

        $ten  = intdiv($number, 10);
        $unit = $number % 10;

        if ($ten === 7) {
            return $unit === 1 ? 'soixante et onze' : 'soixante-' . self::UNITS[10 + $unit];
        }
        if ($ten === 9) {
            return 'quatre-vingt-' . self::UNITS[10 + $unit];
        }
        if ($ten === 8) {
            return $unit === 0 ? 'quatre-vingts' : 'quatre-vingt-' . self::UNITS[$unit];
        }

        $tensWord = self::TENS[$ten];
        if ($unit === 0) {
            return $tensWord;
        }
        if ($unit === 1) {
            return $tensWord . ' et un';
        }

        return $tensWord . '-' . self::UNITS[$unit];
    }
}
