<?php

namespace App\Console\JohnCommands;

use App\Models\Channel;
use Illuminate\Console\Command;

class AddChannelCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'channel:add {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add new channel';

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
        $channel = Channel::create([
            'name'=>$this->argument('name')
        ]);
        $this->info('Added:' . $channel->name);
        return 0;
    }
}
