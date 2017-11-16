# cakephp-google-maps plugin for CakePHP
Proxies Google Map API etc..

## Installation

You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

The recommended way to install composer packages is:

	composer require awallef/cakephp-google-maps

Load it in your config/boostrap.php

	Plugin::load('Awallef/GoogleMaps');

## Set up api key
Configure the engine in app.php like follow:

	'Api' => [
		...
		'google-map-api' => 'XXX'
	]
