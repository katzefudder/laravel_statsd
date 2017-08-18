<?php

/**
 * Created by PhpStorm.
 * User: flo
 * Date: 20.12.15
 * Time: 14:19
 */
class StatsdSenderTest extends PHPUnit_Framework_TestCase {

	private $config = null;
	private $statsdSender = null;

	public function setUp() {
		$this->config = Mockery::mock('Illuminate\Contracts\Config\Repository');
		$this->config->shouldReceive('get')->andReturn(false);

		$this->statsdSender = Mockery::mock('Katzefudder\statsd\statsdSender[sendData]', [$this->config]);
		$this->statsdSender->shouldReceive('sendData')->once()->andReturn(true);
	}


	/**
	 * @test
	 */
	public function dataShouldBeSent() {
		$data = 'teststring';
		$result = $this->statsdSender->sendTostatsd($data);
		$this->assertTrue($result);
	}
}