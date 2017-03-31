<?php

namespace Modules\User\Console;

use Illuminate\Console\Command;

class ClearThrottleCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'clear:throttle';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear Throttle.';

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
    public function fire()
    {
        \DB::table('throttle')->truncate();

        $this->info('Throttles cleared.');
    }
}
