<?php

namespace Usmon\Microcore\Commands;

use Illuminate\Console\Command;

class Bread extends Command
{
    /**
     * Create a new console command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:bread {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $model = $this->argument('model');
        $this->info('Begin create BREAD for model: '.$model);
        $list_actions = [
            'Repository' => [
                'command'  => 'make:repository-api',
                'argument' => $model.'Repository'
            ],
            'Request' => [
                'command'  => 'make:request-api',
                'argument' => $model.'Request'
            ],
            'Service' => [
                'command'  => 'make:service-api',
                'argument' => $model.'Service'
            ],
            'Controller' => [
                'command'  => 'make:controller-api',
                'argument' => $model.'Controller'
            ],
        ];

        foreach ($list_actions as $action_name => $action) {
            $this->comment($action_name);
            $this->call($action['command'], ['name' => $action['argument']]);
        }

        $this->info('BREAD completed');

        return Command::SUCCESS;
    }
}
