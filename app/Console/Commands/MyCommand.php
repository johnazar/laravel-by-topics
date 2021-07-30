<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mycommand {name?} {--G|greeting= : Create a custom greeting} {--B|boo}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'MyCommand to say hello';

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
        $greeting = ($this->option('greeting')) ? $this->option('greeting') : 'no options';
        echo 'This is option: '. $greeting . PHP_EOL;
        $boo = ($this->option('boo')) ? $this->option('boo') : 'no boo' ;
        echo 'This is boolean: '. $boo . PHP_EOL;
        echo 'This is name argument: '. $this->argument('name'). PHP_EOL;
        echo 'MyCommand says hello'. PHP_EOL;
        return 0;
    }
}
