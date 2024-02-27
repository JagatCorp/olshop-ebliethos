<?php

namespace App\Observers;

use App\Jobs\SendWhatsAppMessage;
use App\Models\Order;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order)
    {
        // Periksa apakah status pembayaran berubah menjadi "PAID"
        if ($order->isDirty('payment_status') && $order->payment_status === 'PAID') {
            // Dispatch pekerjaan SendWhatsAppMessage dengan parameter order
            SendWhatsAppMessage::dispatch($order);
        }
    }

    /**
     * Handle the Order "deleted" event.
     */
    public function deleted(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     */
    public function restored(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     */
    public function forceDeleted(Order $order): void
    {
        //
    }
}
