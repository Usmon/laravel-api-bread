<?php

namespace Usmon\Microcore\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Command create Repository
 *
 * @class MakeSeriveApi
 */
class MakeServiceApi extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:service-api';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for service';

    /**
     * @var string
     */
    protected $type = 'ServiceAPI';

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
        $model = str_replace('Service', '', $this->argument('name'));
        $repository = $model.'Repository';

        return str_replace([
            '{{ Class }}', '{{ Repository }}'],
            [$this->argument('name'), ucfirst($repository)],
            $stub);
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return MakeServiceApi . phpbase_path() . DIRECTORY_SEPARATOR .'stubs/service.api.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Services';
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
