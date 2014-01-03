<?php namespace Tlr\Install;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class DatabaseCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'install:db';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = "Set some database details.";

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
		list($path, $contents) = $this->getDatabaseFile();

		// @TODO: write the db details to the file
		// $contents = str_replace($this->laravel['config']['app.key'], $key, $contents);

		// @TODO: save that file!
		// $this->files->put($path, $contents);

		$this->info("Set up database config!");
	}

	/**
	 * Get the key file and contents.
	 *
	 * @return array
	 */
	protected function getDatabaseFile()
	{
		$path = $this->laravel['path'].'/config';

		if ( ! $this->option('default') )
		{
			$path = $path.'/'.$this->getEnvironment();
			// @TODO: if !directoryexists($path), make that directory!
		}

		$path .= '/database.php';

		$contents = $this->files->get($path);

		return array($path, $contents);
	}

	protected function getEnvironment()
	{
		return $this->option('env') ?: $this->laravel->environment();
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
			array('default', 'd', InputOption::VALUE_NONE, 'Whether to use edit the default db file'),
		);
	}

}
