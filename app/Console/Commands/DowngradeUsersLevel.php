<?php

namespace App\Console\Commands;

use App\Http\Controllers\Admin\UsersController;
use Illuminate\Console\Command;

class DowngradeUsersLevel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'downgrade:users_level';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Downgrad level for users who did not meet the conditions of current level ';

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
        $userController=New UsersController();
        $userController->changePriceRange();
        return 'Task Successfully Finshed';
    }
}
