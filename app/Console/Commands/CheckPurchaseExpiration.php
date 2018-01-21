<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\PurchaseOrder;

class CheckPurchaseExpiration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'obc:CheckPurchaseExpiration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verifica si ha pasado mucho tiempo y no se ha aprobado o rechazado una orden de comprar para rechazarla automaticamente';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $currentDate = Carbon::now()->toDateString();
        $purchaseOrders = PurchaseOrder::where('status', 0)->get();

        foreach ($purchaseOrders as $purchase) {
            //dd($purchase->created_at->diffInDays(Carbon::parse('2018-01-26')));
            if ($purchase->created_at->diffInDays(Carbon::now()) >= 5) {
                $purchase->status = 2; //rechazada
                $purchase->save();
            }
        }
    }
}
