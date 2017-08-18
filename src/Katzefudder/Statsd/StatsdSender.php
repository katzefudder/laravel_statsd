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
	public function sendToStatsd($key, $value) {
		$endpoint = $this->config->get('statsd.host');
		$port = $this->config->get('statsd.port');

		// must be an equivalent of `echo "my.test2:2|c" | nc -u -w 1 host.domain 8125`
		$data = $key.'|'.$value;
		return $this->sendData($endpoint, $port, $data);
	}


	/**
	 * Send data via fsockopen (udp)
	 * @param string $endpoint
	 * @param string $data
	 * @return bool
	 */
	public function sendData($endpoint, $port, $data) {
		$connection = fsockopen('udp://'.$endpoint, $port);
		fwrite($connection, $data);
		return fclose($connection);
	}
}