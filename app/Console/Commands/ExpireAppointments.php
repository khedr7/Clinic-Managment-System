<?php

namespace App\Console\Commands;

use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ExpireAppointments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'appointments:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Expire appointments that are past their date';

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
     * @return int
     */
    public function handle()
    {
        $now = Carbon::now();
        $updatedRows = Appointment::where('status', 'pending')
            ->where('date', '<', $now)
            ->update(['status' => 'Expired']);

        $this->info("Expired $updatedRows appointments.");

        return 0;
    }
}
