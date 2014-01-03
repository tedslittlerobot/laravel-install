<?php namespace Tlr\Install;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class EnvironmentCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'install:env';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = "Set the application environment";

	/**
	 * Create a new key generator command.
	 *
	 * @param  \Illuminate\Filesystem\Filesystem  $files
	 * @return void
	 */
	public function __construct(Filesystem $files)
	{
		parent::__construct();

		$this->files = $files;
	}

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function fire()
	{
		list($path, $contents) = $this->getFile();

		$env = $this->argument('environment');

		$contents = $this->replaceEnvironment( $env, $contents );

		$this->files->put($path, $contents);

		$this->line("<info>Environment set to:</info> <comment>{$env}</comment>");
	}

	public function replaceEnvironment( $env, $contents )
	{
		if ($env === 'local')
			return str_replace('your-machine-name', $this->getHostname(), $contents);
	}

	/**
	 * Get the key file and contents.
	 *
	 * @return array
	 */
	protected function getFile()
	{
		$path = $this->laravel['path.base'].'/'.$this->option('file');

		$contents = $this->files->get($path);

		return array($path, $contents);
	}

	/**
	 * Generate a random key for the application.
	 *
	 * @return string
	 */
	protected function getHostname()
	{
		return gethostname();
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('environment', InputArgument::OPTIONAL, 'The environment to set to.', 'local'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('file', null, InputOption::VALUE_OPTIONAL, 'The file where environments are defined.', 'bootstrap/start.php'),
		);
	}


}
