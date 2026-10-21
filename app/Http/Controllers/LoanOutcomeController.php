<?php

namespace App\Http\Controllers;

use App\Models\LoanRequest;
use App\Models\SiteContact;

class LoanOutcomeController extends Controller
{
    public function approved(LoanRequest $loan)
    {
        return $this->render($loan, 'approved');
    }

    public function rejected(LoanRequest $loan)
    {
        return $this->render($loan, 'rejected');
    }

    private function render(LoanRequest $loan, string $decision)
    {
        $locale = $loan->contract_language ?? 'fr';
        $contactEmail = SiteContact::current()->email;

        return view('loan-outcome.show', compact('loan', 'decision', 'locale', 'contactEmail'));
    }
}
