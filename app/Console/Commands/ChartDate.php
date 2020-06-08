<?php

namespace App\Console\Commands;

use App\Models\Purchases\PurchaseDetails;
use App\Models\Sales\SaleDetails;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ChartDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fake:chart';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'change created date for sales and purchases to last 7 days';

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

        $last_days = [];

        for ($i=6; $i >= 0; $i--) {
            array_push($last_days, Carbon::now()->subDays($i)->toDateTimeString());
        }


        foreach(PurchaseDetails::all() as $item) {
            $test = PurchaseDetails::find($item->id);
            $test->created_at = $last_days[rand(0,6)];
            $test->save();
        }

        foreach(SaleDetails::all() as $item) {
            $test = SaleDetails::find($item->id);
            $test->created_at = $last_days[rand(0,6)];
            $test->save();
        }
    }
}
