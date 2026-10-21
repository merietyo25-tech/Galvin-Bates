<?php

namespace App\Services;

/**
 * Écrit un montant en toutes lettres, selon la langue du contrat.
 * Couvre fr/en/es/it/de/nl/ro (grammaires vérifiables avec confiance).
 * Pour les autres langues (pl, bg, hu, lt, lv), repli sur le montant formaté
 * en chiffres plutôt que de risquer une traduction incorrecte dans un contrat.
 */
class NumberToWordsConverter
{
    public static function convert(float $amount, string $locale): string
    {
        return match ($locale) {
            'fr'    => NumberToFrenchWords::convert($amount),
            'en'    => self::convertEn($amount),
            'es'    => self::convertEs($amount),
            'it'    => self::convertIt($amount),
            'de'    => self::convertDe($amount),
            'nl'    => self::convertNl($amount),
            'ro'    => self::convertRo($amount),
            default => number_format($amount, 2, ',', ' '),
        };
    }

    // ══════════════════════════════════════════════════════════ ANGLAIS ══
    private const UNITS_EN = ['zero','one','two','three','four','five','six','seven','eight','nine',
        'ten','eleven','twelve','thirteen','fourteen','fifteen','sixteen','seventeen','eighteen','nineteen'];
    private const TENS_EN = [2=>'twenty',3=>'thirty',4=>'forty',5=>'fifty',6=>'sixty',7=>'seventy',8=>'eighty',9=>'ninety'];

    private static function convertEn(float $amount): string
    {
        $amount = round($amount, 2);
        $int = (int) floor($amount);
        $dec = (int) round(($amount - $int) * 100);
        $words = self::intEn($int);
        if ($dec > 0) {
            $words .= ' and ' . self::intEn($dec) . ' cent' . ($dec > 1 ? 's' : '');
        }
        return $words;
    }

    private static function intEn(int $n): string
    {
        if ($n === 0) return 'zero';
        if ($n < 0) return 'minus ' . self::intEn(-$n);
        $parts = [];
        if ($n >= 1_000_000_000) { $q = intdiv($n, 1_000_000_000); $parts[] = self::under1000En($q) . ' billion'; $n %= 1_000_000_000; }
        if ($n >= 1_000_000)     { $q = intdiv($n, 1_000_000);     $parts[] = self::under1000En($q) . ' million'; $n %= 1_000_000; }
        if ($n >= 1000)          { $q = intdiv($n, 1000);          $parts[] = self::under1000En($q) . ' thousand'; $n %= 1000; }
        if ($n > 0)              { $parts[] = self::under1000En($n); }
        return implode(' ', $parts);
    }

    private static function under1000En(int $n): string
    {
        if ($n < 20) return self::UNITS_EN[$n];
        if ($n < 100) return self::tensEn($n);
        $h = intdiv($n, 100); $rest = $n % 100;
        $str = self::UNITS_EN[$h] . ' hundred';
        if ($rest > 0) $str .= ' and ' . self::tensEn($rest);
        return $str;
    }

    private static function tensEn(int $n): string
    {
        if ($n < 20) return self::UNITS_EN[$n];
        $t = intdiv($n, 10); $u = $n % 10;
        return $u === 0 ? self::TENS_EN[$t] : self::TENS_EN[$t] . '-' . self::UNITS_EN[$u];
    }

    // ══════════════════════════════════════════════════════════ ESPAGNOL ══
    private const UNITS_ES = ['cero','uno','dos','tres','cuatro','cinco','seis','siete','ocho','nueve',
        'diez','once','doce','trece','catorce','quince','dieciséis','diecisiete','dieciocho','diecinueve'];
    private const VEINTI_ES = [0=>'veinte',1=>'veintiuno',2=>'veintidós',3=>'veintitrés',4=>'veinticuatro',
        5=>'veinticinco',6=>'veintiséis',7=>'veintisiete',8=>'veintiocho',9=>'veintinueve'];
    private const TENS_ES = [3=>'treinta',4=>'cuarenta',5=>'cincuenta',6=>'sesenta',7=>'setenta',8=>'ochenta',9=>'noventa'];
    private const HUNDREDS_ES = [2=>'doscientos',3=>'trescientos',4=>'cuatrocientos',5=>'quinientos',
        6=>'seiscientos',7=>'setecientos',8=>'ochocientos',9=>'novecientos'];

    private static function convertEs(float $amount): string
    {
        $amount = round($amount, 2);
        $int = (int) floor($amount);
        $dec = (int) round(($amount - $int) * 100);
        $words = self::intEs($int);
        if ($dec > 0) {
            $words .= ' con ' . self::intEs($dec) . ' céntimo' . ($dec > 1 ? 's' : '');
        }
        return $words;
    }

    private static function intEs(int $n): string
    {
        if ($n === 0) return 'cero';
        if ($n < 0) return 'menos ' . self::intEs(-$n);
        $parts = [];
        if ($n >= 1_000_000_000) { $q = intdiv($n, 1_000_000_000); $parts[] = ($q === 1 ? 'mil millones' : self::under1000Es($q) . ' mil millones'); $n %= 1_000_000_000; }
        if ($n >= 1_000_000)     { $q = intdiv($n, 1_000_000);     $parts[] = ($q === 1 ? 'un millón' : self::under1000Es($q) . ' millones'); $n %= 1_000_000; }
        if ($n >= 1000)          { $q = intdiv($n, 1000);          $parts[] = ($q === 1 ? 'mil' : self::under1000Es($q) . ' mil'); $n %= 1000; }
        if ($n > 0)              { $parts[] = self::under1000Es($n); }
        return implode(' ', $parts);
    }

    private static function under1000Es(int $n): string
    {
        if ($n < 100) return self::under100Es($n);
        $h = intdiv($n, 100); $rest = $n % 100;
        $str = $h === 1 ? ($rest === 0 ? 'cien' : 'ciento') : self::HUNDREDS_ES[$h];
        if ($rest > 0) $str .= ' ' . self::under100Es($rest);
        return $str;
    }

    private static function under100Es(int $n): string
    {
        if ($n < 20) return self::UNITS_ES[$n];
        if ($n < 30) return self::VEINTI_ES[$n - 20];
        $t = intdiv($n, 10); $u = $n % 10;
        return $u === 0 ? self::TENS_ES[$t] : self::TENS_ES[$t] . ' y ' . self::UNITS_ES[$u];
    }

    // ══════════════════════════════════════════════════════════ ITALIEN ══
    private const UNITS_IT = ['zero','uno','due','tre','quattro','cinque','sei','sette','otto','nove',
        'dieci','undici','dodici','tredici','quattordici','quindici','sedici','diciassette','diciotto','diciannove'];
    private const TENS_IT = [2=>'venti',3=>'trenta',4=>'quaranta',5=>'cinquanta',6=>'sessanta',7=>'settanta',8=>'ottanta',9=>'novanta'];

    private static function convertIt(float $amount): string
    {
        $amount = round($amount, 2);
        $int = (int) floor($amount);
        $dec = (int) round(($amount - $int) * 100);
        $words = self::intIt($int);
        if ($dec > 0) {
            $words .= ' e ' . self::intIt($dec) . ' centesim' . ($dec > 1 ? 'i' : 'o');
        }
        return $words;
    }

    private static function intIt(int $n): string
    {
        if ($n === 0) return 'zero';
        if ($n < 0) return 'meno ' . self::intIt(-$n);
        $result = '';
        if ($n >= 1_000_000_000) { $q = intdiv($n, 1_000_000_000); $result .= ($q === 1 ? 'un miliardo' : self::under1000It($q) . ' miliardi') . ' '; $n %= 1_000_000_000; }
        if ($n >= 1_000_000)     { $q = intdiv($n, 1_000_000);     $result .= ($q === 1 ? 'un milione' : self::under1000It($q) . ' milioni') . ' '; $n %= 1_000_000; }
        if ($n >= 1000)          { $q = intdiv($n, 1000);          $result .= ($q === 1 ? 'mille' : self::under1000It($q) . 'mila'); $n %= 1000; }
        if ($n > 0)              { $result .= self::under1000It($n); }
        return trim($result);
    }

    private static function under1000It(int $n): string
    {
        if ($n < 100) return self::under100It($n);
        $h = intdiv($n, 100); $rest = $n % 100;
        $str = $h === 1 ? 'cento' : self::UNITS_IT[$h] . 'cento';
        if ($rest > 0) $str .= self::under100It($rest);
        return $str;
    }

    private static function under100It(int $n): string
    {
        if ($n < 20) return self::UNITS_IT[$n];
        $t = intdiv($n, 10); $u = $n % 10;
        $tensWord = self::TENS_IT[$t];
        if ($u === 0) return $tensWord;
        if ($u === 1 || $u === 8) return substr($tensWord, 0, -1) . self::UNITS_IT[$u];
        if ($u === 3) return $tensWord . 'tré';
        return $tensWord . self::UNITS_IT[$u];
    }

    // ══════════════════════════════════════════════════════════ ALLEMAND ══
    private const UNITS_DE = ['null','eins','zwei','drei','vier','fünf','sechs','sieben','acht','neun',
        'zehn','elf','zwölf','dreizehn','vierzehn','fünfzehn','sechzehn','siebzehn','achtzehn','neunzehn'];
    private const TENS_DE = [2=>'zwanzig',3=>'dreißig',4=>'vierzig',5=>'fünfzig',6=>'sechzig',7=>'siebzig',8=>'achtzig',9=>'neunzig'];

    private static function convertDe(float $amount): string
    {
        $amount = round($amount, 2);
        $int = (int) floor($amount);
        $dec = (int) round(($amount - $int) * 100);
        $words = self::intDe($int);
        if ($dec > 0) {
            $words .= ' und ' . self::intDe($dec) . ' Cent';
        }
        return $words;
    }

    private static function intDe(int $n): string
    {
        if ($n === 0) return 'null';
        if ($n < 0) return 'minus ' . self::intDe(-$n);
        $result = '';
        if ($n >= 1_000_000_000) { $q = intdiv($n, 1_000_000_000); $result .= ($q === 1 ? 'eine Milliarde' : self::under1000De($q) . ' Milliarden') . ' '; $n %= 1_000_000_000; }
        if ($n >= 1_000_000)     { $q = intdiv($n, 1_000_000);     $result .= ($q === 1 ? 'eine Million' : self::under1000De($q) . ' Millionen') . ' '; $n %= 1_000_000; }
        if ($n >= 1000)          { $q = intdiv($n, 1000);          $result .= ($q === 1 ? 'eintausend' : self::under1000De($q) . 'tausend'); $n %= 1000; }
        if ($n > 0)              { $result .= self::under1000De($n); }
        return trim($result);
    }

    private static function under1000De(int $n): string
    {
        if ($n < 100) return self::under100De($n);
        $h = intdiv($n, 100); $rest = $n % 100;
        $str = $h === 1 ? 'einhundert' : self::UNITS_DE[$h] . 'hundert';
        if ($rest > 0) $str .= self::under100De($rest);
        return $str;
    }

    private static function under100De(int $n): string
    {
        if ($n < 20) return self::UNITS_DE[$n];
        $t = intdiv($n, 10); $u = $n % 10;
        $tensWord = self::TENS_DE[$t];
        if ($u === 0) return $tensWord;
        $unitWord = $u === 1 ? 'ein' : self::UNITS_DE[$u];
        return $unitWord . 'und' . $tensWord;
    }

    // ══════════════════════════════════════════════════════════ NÉERLANDAIS ══
    private const UNITS_NL = ['nul','een','twee','drie','vier','vijf','zes','zeven','acht','negen',
        'tien','elf','twaalf','dertien','veertien','vijftien','zestien','zeventien','achttien','negentien'];
    private const TENS_NL = [2=>'twintig',3=>'dertig',4=>'veertig',5=>'vijftig',6=>'zestig',7=>'zeventig',8=>'tachtig',9=>'negentig'];

    private static function convertNl(float $amount): string
    {
        $amount = round($amount, 2);
        $int = (int) floor($amount);
        $dec = (int) round(($amount - $int) * 100);
        $words = self::intNl($int);
        if ($dec > 0) {
            $words .= ' en ' . self::intNl($dec) . ' cent';
        }
        return $words;
    }

    private static function intNl(int $n): string
    {
        if ($n === 0) return 'nul';
        if ($n < 0) return 'min ' . self::intNl(-$n);
        $result = '';
        if ($n >= 1_000_000_000) { $q = intdiv($n, 1_000_000_000); $result .= ($q === 1 ? 'een miljard' : self::under1000Nl($q) . ' miljard') . ' '; $n %= 1_000_000_000; }
        if ($n >= 1_000_000)     { $q = intdiv($n, 1_000_000);     $result .= ($q === 1 ? 'een miljoen' : self::under1000Nl($q) . ' miljoen') . ' '; $n %= 1_000_000; }
        if ($n >= 1000)          { $q = intdiv($n, 1000);          $result .= ($q === 1 ? 'duizend' : self::under1000Nl($q) . 'duizend'); $n %= 1000; }
        if ($n > 0)              { $result .= self::under1000Nl($n); }
        return trim($result);
    }

    private static function under1000Nl(int $n): string
    {
        if ($n < 100) return self::under100Nl($n);
        $h = intdiv($n, 100); $rest = $n % 100;
        $str = $h === 1 ? 'honderd' : self::UNITS_NL[$h] . 'honderd';
        if ($rest > 0) $str .= self::under100Nl($rest);
        return $str;
    }

    private static function under100Nl(int $n): string
    {
        if ($n < 20) return self::UNITS_NL[$n];
        $t = intdiv($n, 10); $u = $n % 10;
        $tensWord = self::TENS_NL[$t];
        if ($u === 0) return $tensWord;
        return self::UNITS_NL[$u] . 'en' . $tensWord;
    }

    // ══════════════════════════════════════════════════════════ ROUMAIN ══
    private const UNITS_RO = ['zero','unu','doi','trei','patru','cinci','șase','șapte','opt','nouă',
        'zece','unsprezece','doisprezece','treisprezece','paisprezece','cincisprezece','șaisprezece','șaptesprezece','optsprezece','nouăsprezece'];
    private const TENS_RO = [2=>'douăzeci',3=>'treizeci',4=>'patruzeci',5=>'cincizeci',6=>'șaizeci',7=>'șaptezeci',8=>'optzeci',9=>'nouăzeci'];
    private const HUNDREDS_RO = [3=>'trei',4=>'patru',5=>'cinci',6=>'șase',7=>'șapte',8=>'opt',9=>'nouă'];

    private static function convertRo(float $amount): string
    {
        $amount = round($amount, 2);
        $int = (int) floor($amount);
        $dec = (int) round(($amount - $int) * 100);
        $words = self::intRo($int);
        if ($dec > 0) {
            $words .= ' și ' . self::intRo($dec) . ' bani';
        }
        return $words;
    }

    private static function intRo(int $n): string
    {
        if ($n === 0) return 'zero';
        if ($n < 0) return 'minus ' . self::intRo(-$n);
        $parts = [];
        // Roumain : "de" s'intercale entre le compte et mii/milioane dès que ce compte est >= 20
        // (ex. "cincisprezece mii" mais "o sută DE mii", "douăzeci DE milioane").
        if ($n >= 1_000_000) {
            $q = intdiv($n, 1_000_000);
            $parts[] = $q === 1 ? 'un milion' : self::countRo($q) . ($q >= 20 ? ' de milioane' : ' milioane');
            $n %= 1_000_000;
        }
        if ($n >= 1000) {
            $q = intdiv($n, 1000);
            $parts[] = $q === 1 ? 'o mie' : self::countRo($q) . ($q >= 20 ? ' de mii' : ' mii');
            $n %= 1000;
        }
        if ($n > 0) { $parts[] = self::under1000Ro($n); }
        return implode(' ', $parts);
    }

    // Compte utilisé devant sută/mie/milion : "două" (fém./neutre) au lieu de "doi" pour 2.
    private static function countRo(int $n): string
    {
        return $n === 2 ? 'două' : self::under1000Ro($n);
    }

    private static function under1000Ro(int $n): string
    {
        if ($n < 100) return self::under100Ro($n);
        $h = intdiv($n, 100); $rest = $n % 100;
        $str = $h === 1 ? 'o sută' : ($h === 2 ? 'două sute' : self::HUNDREDS_RO[$h] . ' sute');
        if ($rest > 0) $str .= ' ' . self::under100Ro($rest);
        return $str;
    }

    private static function under100Ro(int $n): string
    {
        if ($n < 20) return self::UNITS_RO[$n];
        $t = intdiv($n, 10); $u = $n % 10;
        return $u === 0 ? self::TENS_RO[$t] : self::TENS_RO[$t] . ' și ' . self::UNITS_RO[$u];
    }
}
