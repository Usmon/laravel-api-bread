<?php

namespace Usmon\Microcore\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Command create Repository
 *
 * @class MakeRepositoryApi
 */
class MakeRepositoryApi extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:repository-api';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for repository';

    /**
     * @var string
     */
    protected $type = 'RepositoryAPI';

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
        $model = str_replace('Repository', '', $this->argument('name'));

        return str_replace([
            '{{ Class }}', '{{ Model }}'],
            [$this->argument('name'), ucfirst($model)],
            $stub);
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return MakeRepositoryApi . phpbase_path() . DIRECTORY_SEPARATOR .'stubs/repository.api.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Repositories';
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
