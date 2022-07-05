<?php

namespace App\Console\Commands;

use App\Http\Controllers\Admin\UsersController;
use App\Models\User;
use Illuminate\Console\Command;

class DowngradeLevel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'downgrade:level';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $user = User::findOrFail(2);
        $user->balance = 10;
        $user->save();

        $userController=New UsersController();
        $userController->changePriceRange();
        return 'Task Successfully Finshed';
//        return 0;
    }
}
