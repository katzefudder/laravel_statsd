<?php

namespace Katzefudder\Statsd;

use Illuminate\Support\ServiceProvider;

class StatsdServiceProvider extends ServiceProvider {
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot() {
		// Publish a config file
		$this->publishes([
			__DIR__.'/../../config/statsd.php' => config_path('statsd.php'),
		], 'config');
	}

 /**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register() {
		$this->app->bind(
			'statsd', 'Katzefudder\Statsd\StatsdSender'
		);
	}
}
