<?php

namespace App\Console;

use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    /**
     * {@inheritDoc}
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        //require base_path('routes/console.php');
    }

}
