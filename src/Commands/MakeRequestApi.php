<?php

namespace Usmon\Microcore\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Command create Request for API
 *
 * @class Make request for API
 */
class MakeRequestApi extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:request-api';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for API request';

    /**
     * @var string
     */
    protected $type = 'RequestAPI';

    /**
     * Replace the class name for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return string
     */
    protected function replaceClass($stub, $name)
    {
        $stub = parent::replaceClass($stub, $name);
        $model = str_replace('Request', '', $this->argument('name'));

        return str_replace([
            '{{ Class }}', '{{ table }}','{{ parameter }}'],
            [$this->argument('name'), strtolower($model).'s', strtolower($model)],
            $stub);
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return MakeRequestApi . phpbase_path() . DIRECTORY_SEPARATOR .'stubs/request.api.controller.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Http\Requests';
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the request.'],
        ];
    }
}
