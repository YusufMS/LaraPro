<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SayHello extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'say:hello {fname}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'A command that returns with a greeting';

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
        $fname = $this->argument('fname');
        $this->info('Hello '. $fname);
        // $this->info('Hello Guys');
        // $this->error('Hello Guys');
        // $this->line('Hello Guys');
        // $this->info('Hello Guys');
        // $this->info('Hello Guys');
    }
}
