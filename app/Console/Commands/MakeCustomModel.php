<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeCustomModel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:model {cutomClass}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create a custom model';

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
        $cutomClass = ($this->argument('cutomClass'));
        $template = \File::get('stubs/custommodel.stub');
        $to_replace = ['{{ class }}'];
        $replacwith = $cutomClass;
        $result = str_replace($to_replace,$replacwith,$template);
        \File::put("app/Models/{$cutomClass}.php",$result);
    }
}
