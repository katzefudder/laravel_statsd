<?php

namespace Katzefudder\Statsd;

use Illuminate\Contracts\Config\Repository;

class StatsdSender {

	private $config = null;

	public function __construct(Repository $config) {
		$this->config = $config;
	}


	/**
	 * Data to send to Graphite host
	 * @param string $data
	 * @return bool
	 */
	public function send($key, $value, $type = 'c') {
		$endpoint = $this->config->get('statsd.host');
		$port = $this->config->get('statsd.port');

		$data = $key.':'.$value.'|'.$type;
		return $this->sendToStatsd($endpoint, $port, $data);
	}


	/**
	 * Send data via fsockopen (udp)
	 * @param string $endpoint
	 * @param string $data
	 * @return bool
	 */
	public function sendToStatsd($endpoint, $port, $data) {
		$connection = fsockopen('udp://'.$endpoint, $port);
		fwrite($connection, $data);
		return fclose($connection);
	}
}