# Send data to statsd

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/katzefudder/laravel_statsd/master.svg?style=flat-square)](https://travis-ci.org/katzefudder/laravel_statsd)

This Laravel 5 package provides a very easy to use solution to send data to statsd

## Laravel config
Add `StatsdServiceProvider` to providers' array
Add `StatsdFacade` to alias' array

```
# config.php

'providers' => [
...
Katzefudder\Statsd\StatsdServiceProvider::class
...
];

'aliases' => [
...
'Statsd' => Katzefudder\Statsd\StatsdFacade::class
...
];

```