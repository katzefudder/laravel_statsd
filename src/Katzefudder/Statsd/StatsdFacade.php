<?php
namespace Katzefudder\Statsd;
use Illuminate\Support\Facades\Facade;

class StatsdFacade extends Facade {
	protected static function getFacadeAccessor() {
		return 'statsd';
	}
}