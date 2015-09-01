<?php namespace Keios\GeoIP\Console;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Console\Command;
use Keios\GeoIP\GeoIPUpdater;

class UpdateCommand extends Command
{
	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'geoip:update';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Update geoip database files to the latest version';

	/**
	 * @var \Keios\GeoIP\GeoIPUpdater
	 */
	protected $geoIPUpdater;

	/**
	 * Create a new console command instance.
	 *
	 * @param \Illuminate\Contracts\Config\Repository $config
	 */
	public function __construct(Repository $config)
	{
		parent::__construct();

		$this->geoIPUpdater = new GeoIPUpdater($config);
	}

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function fire()
	{
		$result = $this->geoIPUpdater->update();

		if (!$result) {
			$this->error('Update failed!');

			return;
		}

		$this->info('New update file ('.$result.') installed.');
	}
}