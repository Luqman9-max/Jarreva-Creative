<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendEmailNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;

    public function __construct(
        public string $to,
        public string $subject,
        public string $html,
        public ?string $replyTo = null
    ) {}

    /**
     * Send email via Resend HTTP API (port 443, never blocked by cloud providers).
     */
    public function handle(): void
    {
        $apiKey = config('services.resend.key');

        if (empty($apiKey)) {
            Log::warning('RESEND_API_KEY not set, skipping email: ' . $this->subject);
            return;
        }

        $payload = [
            'from' => config('mail.from.name', 'Jarreva Creative') . ' <onboarding@resend.dev>',
            'to' => [$this->to],
            'subject' => $this->subject,
            'html' => $this->html,
        ];

        if ($this->replyTo) {
            $payload['reply_to'] = $this->replyTo;
        }

        $response = Http::withToken($apiKey)
            ->timeout(15)
            ->post('https://api.resend.com/emails', $payload);

        if ($response->successful()) {
            Log::info('Email sent via Resend: ' . $this->subject);
        } else {
            Log::error('Resend API error: ' . $response->body());
            throw new \Exception('Resend API failed: ' . $response->status());
        }
    }
}
