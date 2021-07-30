<?php

namespace App\Console\JohnCommands;

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
        
        $letters = ['a','b','c','d','e'];
        $this->withProgressBar($letters,function ($letter)
        {
            echo $letter . PHP_EOL;
            sleep(1);
        });

        // input
        $customInput = $this->ask('type any things to continue');
        echo 'you typed: '.$customInput. PHP_EOL;
        // password
        $customPass = $this->secret('Password input demo');
        echo 'your password: '. str_repeat('*',strlen($customPass)). PHP_EOL;
        // confirmation
        $confirmation = $this->confirm('do you confirm?');
        echo ($confirmation) ? 'confirmed' : 'not confirmed' ;
        echo PHP_EOL;

        // autocomplate
        $country = $this->anticipate('Where are you from?',['USA','UAE','Canad','Japan']);
        $this->line("you are from {$country}" . PHP_EOL);
        
        // select
        $backend = $this->choice('favourite language',['PHP','Python','JS']);
        $this->alert("you choosed {$backend}" . PHP_EOL);
        
        // multi select
        $backends = $this->choice('favourite language',
        ['PHP','Python','JS'],
        $default = 1,
        $attempts =3,
        $multiple =True);
        var_dump($backends) . PHP_EOL;

        $greeting = ($this->option('greeting')) ? $this->option('greeting') : 'no options';
        echo 'This is option: '. $greeting . PHP_EOL;
        $boo = ($this->option('boo')) ? $this->option('boo') : 'no boo' ;
        echo 'This is boolean: '. $boo . PHP_EOL;
        echo 'This is name argument: '. $this->argument('name'). PHP_EOL;
        echo 'MyCommand says hello'. $this->output->newLine();


        return 0;
    }
}
