<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendWhatsAppMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function handle()
    {
        // Periksa apakah status pembayaran adalah "PAID"
        if ($this->order->payment_status === 'PAID') {
            // Kirim pesan WhatsApp
            $response = Http::post('http://localhost:8000/send-message', [
                // 'message' => 'Halo! Invoice Anda dengan code ' . $this->order->code . ' telah berhasil dibayar.',
                'message' => 'Halo! Invoice Anda dengan code ',
                'number' => $this->order->customer_phone,
            ]);

            // Lakukan penanganan respons API WhatsApp di sini, misalnya log atau lainnya
            if ($response->successful()) {
                Log::info('Pesan WhatsApp berhasil dikirim.');
            } else {
                Log::error('Gagal mengirim pesan WhatsApp: ' . $response->body());
            }
        }
    }
}
