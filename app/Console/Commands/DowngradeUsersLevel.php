<?php

namespace App\Console\Commands;

use App\Http\Controllers\Admin\UsersController;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;

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
//        $user = User::findOrFail(15);
//        $user->balance = 10;
//        $user->save();

        $userController=New UsersController();
        $userController->changePriceRange();
        return 'Task Successfully Finshed';
    }
}
