<?php

use PHPUnit\Framework\TestCase;

class StatsdSenderTest extends TestCase {

	private $config = null;
	private $statsdSender = null;

	public function setUp() {
		$this->config = Mockery::mock('Illuminate\Contracts\Config\Repository');
		$this->config->shouldReceive('get')->andReturn(false);

		$this->statsdSender = Mockery::mock('Katzefudder\Statsd\statsdSender[sendData]', [$this->config]);
		$this->statsdSender->shouldReceive('sendData')->once()->andReturn(true);
	}


	/**
	 * @test
	 */
	public function dataShouldBeSent() {
		$key = 'teststring';
		$value = '1';
		$result = $this->statsdSender->sendToStatsd($key, $value);
		$this->assertTrue($result);
	}
}