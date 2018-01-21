<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;

class CheckExpirationDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'obc:CheckExpirationDate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verifica la fecha de expiracion de las solicitudes de cotizacion para desabilitarlas';

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

        \DB::table('quotation_requests')
            ->where('status', 1)
            ->where('exp_date', '<', $currentDate)
            ->update(['status' => 0]); //desabilitarla
    }
}
