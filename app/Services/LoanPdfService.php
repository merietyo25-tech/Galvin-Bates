<?php

namespace App\Services;

use App\Models\LoanRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class LoanPdfService
{
    public function __construct(
        private ContractHtmlService $htmlService,
    ) {}

    /**
     * Génère le PDF du contrat et retourne son chemin absolu.
     */
    public function generate(LoanRequest $loan, string $locale = 'fr'): string
    {
        $loan->contract_language = $locale;
        return $this->htmlService->generate($loan);
    }

    /**
     * Génère le PDF du tableau d'amortissement et retourne son chemin absolu.
     */
    public function generateAmortizationPdf(LoanRequest $loan, string $locale = 'fr'): string
    {
        $translations = [
            'fr' => [
                'title'          => 'TABLEAU D\'AMORTISSEMENT',
                'header_sub'     => 'Organisme de financement — Solutions de crédit',
                'ref'            => 'Référence dossier',
                'date'           => 'Date',
                'amount'         => 'Montant du prêt',
                'duration'       => 'Durée',
                'months'         => 'mois',
                'monthly'        => 'Mensualité',
                'rate'           => 'Taux annuel',
                'total_interest' => 'Coût total des intérêts',
                'total_repaid'   => 'Total à rembourser',
                'col_month'      => 'Mois',
                'col_payment'    => 'Mensualité',
                'col_principal'  => 'Capital',
                'col_interest'   => 'Intérêts',
                'col_balance'    => 'Solde restant',
                'total'          => 'TOTAL',
                'footer'         => 'Document généré automatiquement',
            ],
            'en' => [
                'title'          => 'AMORTIZATION SCHEDULE',
                'header_sub'     => 'Financing institution — Credit solutions',
                'ref'            => 'File reference',
                'date'           => 'Date',
                'amount'         => 'Loan amount',
                'duration'       => 'Duration',
                'months'         => 'months',
                'monthly'        => 'Monthly payment',
                'rate'           => 'Annual rate',
                'total_interest' => 'Total interest cost',
                'total_repaid'   => 'Total to repay',
                'col_month'      => 'Month',
                'col_payment'    => 'Payment',
                'col_principal'  => 'Principal',
                'col_interest'   => 'Interest',
                'col_balance'    => 'Remaining balance',
                'total'          => 'TOTAL',
                'footer'         => 'Automatically generated document',
            ],
            'pl' => [
                'title'          => 'HARMONOGRAM SPŁAT',
                'header_sub'     => 'Instytucja finansowa — Rozwiązania kredytowe',
                'ref'            => 'Numer referencyjny',
                'date'           => 'Data',
                'amount'         => 'Kwota pożyczki',
                'duration'       => 'Okres',
                'months'         => 'miesięcy',
                'monthly'        => 'Miesięczna rata',
                'rate'           => 'Stopa roczna',
                'total_interest' => 'Łączny koszt odsetek',
                'total_repaid'   => 'Łączna kwota do spłaty',
                'col_month'      => 'Miesiąc',
                'col_payment'    => 'Płatność',
                'col_principal'  => 'Kapitał',
                'col_interest'   => 'Odsetki',
                'col_balance'    => 'Pozostałe saldo',
                'total'          => 'RAZEM',
                'footer'         => 'Dokument wygenerowany automatycznie',
            ],
            'es' => [
                'title'          => 'CUADRO DE AMORTIZACIÓN',
                'header_sub'     => 'Entidad financiera — Soluciones de crédito',
                'ref'            => 'Referencia del expediente',
                'date'           => 'Fecha',
                'amount'         => 'Importe del préstamo',
                'duration'       => 'Duración',
                'months'         => 'meses',
                'monthly'        => 'Cuota mensual',
                'rate'           => 'Tasa anual',
                'total_interest' => 'Coste total de intereses',
                'total_repaid'   => 'Total a reembolsar',
                'col_month'      => 'Mes',
                'col_payment'    => 'Pago',
                'col_principal'  => 'Capital',
                'col_interest'   => 'Intereses',
                'col_balance'    => 'Saldo restante',
                'total'          => 'TOTAL',
                'footer'         => 'Documento generado automáticamente',
            ],
            'de' => [
                'title'          => 'TILGUNGSPLAN',
                'header_sub'     => 'Finanzierungsinstitut — Kreditlösungen',
                'ref'            => 'Aktenreferenz',
                'date'           => 'Datum',
                'amount'         => 'Darlehensbetrag',
                'duration'       => 'Laufzeit',
                'months'         => 'Monate',
                'monthly'        => 'Monatliche Rate',
                'rate'           => 'Jahreszins',
                'total_interest' => 'Gesamtzinskosten',
                'total_repaid'   => 'Gesamtrückzahlung',
                'col_month'      => 'Monat',
                'col_payment'    => 'Rate',
                'col_principal'  => 'Kapital',
                'col_interest'   => 'Zinsen',
                'col_balance'    => 'Restsaldo',
                'total'          => 'GESAMT',
                'footer'         => 'Automatisch erstelltes Dokument',
            ],
            'it' => [
                'title'          => 'PIANO DI AMMORTAMENTO',
                'header_sub'     => 'Istituto di finanziamento — Soluzioni di credito',
                'ref'            => 'Riferimento pratica',
                'date'           => 'Data',
                'amount'         => 'Importo del prestito',
                'duration'       => 'Durata',
                'months'         => 'mesi',
                'monthly'        => 'Rata mensile',
                'rate'           => 'Tasso annuo',
                'total_interest' => 'Costo totale degli interessi',
                'total_repaid'   => 'Totale da rimborsare',
                'col_month'      => 'Mese',
                'col_payment'    => 'Rata',
                'col_principal'  => 'Capitale',
                'col_interest'   => 'Interessi',
                'col_balance'    => 'Saldo residuo',
                'total'          => 'TOTALE',
                'footer'         => 'Documento generato automaticamente',
            ],
            'nl' => [
                'title'          => 'AFLOSSINGSTABEL',
                'header_sub'     => 'Financieringsinstelling — Kredietoplossingen',
                'ref'            => 'Dossierreferentie',
                'date'           => 'Datum',
                'amount'         => 'Leningbedrag',
                'duration'       => 'Looptijd',
                'months'         => 'maanden',
                'monthly'        => 'Maandelijkse termijn',
                'rate'           => 'Jaarlijkse rente',
                'total_interest' => 'Totale rentekosten',
                'total_repaid'   => 'Totaal terug te betalen',
                'col_month'      => 'Maand',
                'col_payment'    => 'Termijn',
                'col_principal'  => 'Kapitaal',
                'col_interest'   => 'Rente',
                'col_balance'    => 'Resterend saldo',
                'total'          => 'TOTAAL',
                'footer'         => 'Automatisch gegenereerd document',
            ],
            'pt' => [
                'title'          => 'TABELA DE AMORTIZAÇÃO',
                'header_sub'     => 'Instituição de financiamento — Soluções de crédito',
                'ref'            => 'Referência do processo',
                'date'           => 'Data',
                'amount'         => 'Montante do empréstimo',
                'duration'       => 'Duração',
                'months'         => 'meses',
                'monthly'        => 'Prestação mensal',
                'rate'           => 'Taxa anual',
                'total_interest' => 'Custo total dos juros',
                'total_repaid'   => 'Total a reembolsar',
                'col_month'      => 'Mês',
                'col_payment'    => 'Prestação',
                'col_principal'  => 'Capital',
                'col_interest'   => 'Juros',
                'col_balance'    => 'Saldo remanescente',
                'total'          => 'TOTAL',
                'footer'         => 'Documento gerado automaticamente',
            ],
            'ro' => [
                'title'          => 'GRAFIC DE RAMBURSARE',
                'header_sub'     => 'Instituție de finanțare — Soluții de credit',
                'ref'            => 'Referință dosar',
                'date'           => 'Data',
                'amount'         => 'Suma împrumutului',
                'duration'       => 'Durata',
                'months'         => 'luni',
                'monthly'        => 'Rată lunară',
                'rate'           => 'Rată anuală',
                'total_interest' => 'Costul total al dobânzii',
                'total_repaid'   => 'Total de rambursat',
                'col_month'      => 'Lună',
                'col_payment'    => 'Rată',
                'col_principal'  => 'Capital',
                'col_interest'   => 'Dobândă',
                'col_balance'    => 'Sold rămas',
                'total'          => 'TOTAL',
                'footer'         => 'Document generat automat',
            ],
            'lv' => [
                'title'          => 'ATMAKSAS GRAFIKS',
                'header_sub'     => 'Finansēšanas iestāde — Kredīta risinājumi',
                'ref'            => 'Lietas numurs',
                'date'           => 'Datums',
                'amount'         => 'Aizdevuma summa',
                'duration'       => 'Termiņš',
                'months'         => 'mēneši',
                'monthly'        => 'Ikmēneša maksājums',
                'rate'           => 'Gada likme',
                'total_interest' => 'Kopējās procentu izmaksas',
                'total_repaid'   => 'Kopā atmaksājams',
                'col_month'      => 'Mēnesis',
                'col_payment'    => 'Maksājums',
                'col_principal'  => 'Pamatsumma',
                'col_interest'   => 'Procenti',
                'col_balance'    => 'Atlikusī summa',
                'total'          => 'KOPĀ',
                'footer'         => 'Automātiski ģenerēts dokuments',
            ],
            'lt' => [
                'title'          => 'GRĄŽINIMO GRAFIKAS',
                'header_sub'     => 'Finansavimo įstaiga — Kredito sprendimai',
                'ref'            => 'Bylos numeris',
                'date'           => 'Data',
                'amount'         => 'Paskolos suma',
                'duration'       => 'Trukmė',
                'months'         => 'mėn.',
                'monthly'        => 'Mėnesinė įmoka',
                'rate'           => 'Metinė palūkanų norma',
                'total_interest' => 'Bendra palūkanų suma',
                'total_repaid'   => 'Iš viso grąžinti',
                'col_month'      => 'Mėnuo',
                'col_payment'    => 'Įmoka',
                'col_principal'  => 'Pagrindinė suma',
                'col_interest'   => 'Palūkanos',
                'col_balance'    => 'Likusi suma',
                'total'          => 'IŠ VISO',
                'footer'         => 'Automatiškai sugeneruotas dokumentas',
            ],
            'bg' => [
                'title'          => 'ПОГАСИТЕЛЕН ПЛАН',
                'header_sub'     => 'Финансираща институция — Кредитни решения',
                'ref'            => 'Референтен номер на досие',
                'date'           => 'Дата',
                'amount'         => 'Размер на заема',
                'duration'       => 'Срок',
                'months'         => 'месеца',
                'monthly'        => 'Месечна вноска',
                'rate'           => 'Годишен лихвен процент',
                'total_interest' => 'Обща лихва',
                'total_repaid'   => 'Обща сума за връщане',
                'col_month'      => 'Месец',
                'col_payment'    => 'Вноска',
                'col_principal'  => 'Главница',
                'col_interest'   => 'Лихва',
                'col_balance'    => 'Остатък',
                'total'          => 'ОБЩО',
                'footer'         => 'Автоматично генериран документ',
            ],
            'hu' => [
                'title'          => 'TÖRLESZTÉSI ÜTEMTERV',
                'header_sub'     => 'Finanszírozó intézmény — Hitelmegoldások',
                'ref'            => 'Ügyszám',
                'date'           => 'Dátum',
                'amount'         => 'Kölcsön összege',
                'duration'       => 'Futamidő',
                'months'         => 'hónap',
                'monthly'        => 'Havi törlesztőrészlet',
                'rate'           => 'Éves kamatláb',
                'total_interest' => 'Teljes kamatköltség',
                'total_repaid'   => 'Visszafizetendő összesen',
                'col_month'      => 'Hónap',
                'col_payment'    => 'Törlesztőrészlet',
                'col_principal'  => 'Tőke',
                'col_interest'   => 'Kamat',
                'col_balance'    => 'Fennmaradó egyenleg',
                'total'          => 'ÖSSZESEN',
                'footer'         => 'Automatikusan generált dokumentum',
            ],
        ];

        $texts    = $translations[$locale] ?? $translations['fr'];
        $schedule = $loan->amortization_schedule ?? [];

        $logoBase64 = $this->documentLogoBase64();

        $html = view('pdfs.amortization-table', [
            'loan'        => $loan,
            'locale'      => $locale,
            'texts'       => $texts,
            'schedule'    => $schedule,
            'logoBase64'  => $logoBase64,
        ])->render();

        $pdf = Pdf::loadHTML($html)
            ->setPaper('a4', 'portrait')
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled'      => false,
                'defaultFont'          => 'DejaVu Serif',
            ]);

        $filename = 'amortization_' . $loan->reference . '_' . $locale . '.pdf';
        $path     = 'contracts/' . $filename;

        Storage::disk('local')->makeDirectory('contracts');
        Storage::disk('local')->put($path, $pdf->output());

        return storage_path('app/' . $path);
    }

    /**
     * Logo du document, en data URI, redimensionne pour DomPDF.
     *
     * L ancienne version inlinait public/assets/images/logo new.png : 419 Ko, soit
     * ~575 Ko de base64 injectes dans le HTML. DomPDF y consomme beaucoup de memoire
     * et de temps, ce qui faisait echouer la generation sur un hebergement contraint —
     * echec avale par le try/catch appelant, donc email expedie SANS le tableau.
     *
     * On part desormais du logo televerse en admin (coherent avec le reste du site),
     * avec repli sur le PNG historique, et on plafonne la largeur.
     */
    private function documentLogoBase64(int $maxWidth = 420): ?string
    {
        $source = null;

        $contact = function_exists('site_identity') ? site_identity() : null;
        foreach ([$contact?->logo_light_path, $contact?->logo_dark_path] as $rel) {
            if ($rel && Storage::disk('public')->exists($rel)) {
                $source = Storage::disk('public')->path($rel);
                break;
            }
        }

        if (! $source) {
            $fallback = public_path('assets/images/logo new.png');
            $source   = is_file($fallback) ? $fallback : null;
        }

        if (! $source) {
            return null;
        }

        try {
            $src = @imagecreatefromstring((string) file_get_contents($source));
            if ($src === false) {
                return null;
            }

            $w = imagesx($src);
            $h = imagesy($src);

            if ($w > $maxWidth) {
                $nh     = (int) round($h * ($maxWidth / $w));
                $resized = imagecreatetruecolor($maxWidth, $nh);
                imagealphablending($resized, false);
                imagesavealpha($resized, true);
                imagecopyresampled($resized, $src, 0, 0, 0, 0, $maxWidth, $nh, $w, $h);
                imagedestroy($src);
                $src = $resized;
            }

            ob_start();
            imagepng($src, null, 8);
            $bin = (string) ob_get_clean();
            imagedestroy($src);

            return 'data:image/png;base64,' . base64_encode($bin);
        } catch (\Throwable $e) {
            return null;
        }
    }
}
