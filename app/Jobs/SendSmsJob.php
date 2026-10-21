<?php

namespace App\Jobs;

use App\Models\SmsMessage;
use App\Services\SmsService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendSmsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 1; // un échec est journalisé (statut "failed"), pas rejoué : évite les doublons de SMS

    public function __construct(public SmsMessage $message)
    {
    }

    public function handle(SmsService $sms): void
    {
        $sms->deliver($this->message->fresh());
    }

    public function failed(\Throwable $e): void
    {
        $this->message->update(['status' => 'failed', 'error' => mb_substr($e->getMessage(), 0, 200)]);
    }
}
