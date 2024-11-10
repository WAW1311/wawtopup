<?php

namespace App\Jobs;

use App\Http\Controllers\TripayController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\ApiProduct;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\VipPaymentController;

class SyncProducts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $product = new VipPaymentController;

        $products = $product->GetProduct();

        foreach ($products as $productData) {
            ApiProduct::updateOrCreate(
                ['code' => $productData->code],
                [
                    'game' => $productData->game,
                    'name' => $productData->name,
                    'price' => $productData->price->basic,
                ]
            );
        }
    }
}
