<?php

use PHPUnit\Framework\TestCase;

class StatsdSenderTest extends TestCase {

	private $config = null;
	private $statsdSender = null;

	public function setUp() {
		$this->config = Mockery::mock('Illuminate\Contracts\Config\Repository');
		$this->config->shouldReceive('get')->andReturn(false);

		$this->statsdSender = Mockery::mock('Katzefudder\Statsd\StatsdSender[sendToStatsd]', [$this->config]);
	}
	
	
	/**
	 * @test
	 */
	public function dataShouldBeInExpectedFormat() {
		$key = 'login';
		$value = '1';
		$type = 'g';
		$expected = $key.':'.$value.'|'.$type;
		
		$this->statsdSender->shouldReceive('sendToStatsd')->once()->withArgs([false, false, $expected])->andReturn(true);
		$this->statsdSender->send($key, $value, $type);
	}

	/**
	 * @test
	 */
	public function dataShouldBeSent() {
		$key = 'teststring';
		$value = '1';
		$this->statsdSender->shouldReceive('sendToStatsd')->once()->andReturn(true);
		$result = $this->statsdSender->send($key, $value);
		$this->assertTrue($result);
	}
}