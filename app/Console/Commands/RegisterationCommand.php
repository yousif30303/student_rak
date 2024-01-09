<?php

namespace App\Console\Commands;

use App\Http\Controllers\ApiController;
use App\Models\Student;
use App\Models\RegisterNotifi;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Notifications\regisNotification;
use Illuminate\Support\Facades\Notification;

class RegisterationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'register:new';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'new Registeration student email job';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $api = app(ApiController::class);
        $api->regTest();
    
    }

}
