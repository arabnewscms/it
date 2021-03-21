<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Upload dir
	|--------------------------------------------------------------------------
	|
	| The dir where to store the images (relative from public)
	|
	 */
	'dir' => ['../'],

	/*
	|--------------------------------------------------------------------------
	| Filesystem disks (Flysytem)
	|--------------------------------------------------------------------------
	|
	| Define an array of Filesystem disks, which use Flysystem.
	| You can set extra options, example:
	|
	| 'my-disk' => [
	|        'URL' => url('to/disk'),
	|        'alias' => 'Local storage',
	|    ]
	 */
	'disks'    => [
		'public'  => [
			'driver' => 'Filesystem',
			'root'   => base_path(),
		],

	],

	/*
	|--------------------------------------------------------------------------
	| Routes group config
	|--------------------------------------------------------------------------
	|
	| The default group settings for the elFinder routes.
	|
	 */

	'route'       => [
		'prefix'     => '',
		'middleware' => 'web', //Set to null to disable middleware filter
	],

	/*
	|--------------------------------------------------------------------------
	| Access filter
	|--------------------------------------------------------------------------
	|
	| Filter callback to check the files
	|
	 */

	'access' => 'Barryvdh\Elfinder\Elfinder::checkAccess',

	/*
	|--------------------------------------------------------------------------
	| Roots
	|--------------------------------------------------------------------------
	|
	| By default, the roots file is LocalFileSystem, with the above public dir.
	| If you want custom options, you can set your own roots below.
	|
	 */

	'roots' => array(
		[

			'driver' => 'LocalFileSystem',
			'path'   => base_path(),
			'URL'    => 'http://localhost/to/files/'
		],
		[
			'driver' => 'FTP',
			'host'   => 'ftp://192.168.1.2',
			'user'   => '',
			'pass'   => '',
			'path'   => '/',
		]

	),

	/*
	|--------------------------------------------------------------------------
	| Options
	|--------------------------------------------------------------------------
	|
	| These options are merged, together with 'roots' and passed to the Connector.
	| See https://github.com/Studio-42/elFinder/wiki/Connector-configuration-options-2.1
	|
	 */

	'options' => array(
		'roots',
	),

	/*
	|--------------------------------------------------------------------------
	| Root Options
	|--------------------------------------------------------------------------
	|
	| These options are merged, together with every root by default.
	| See https://github.com/Studio-42/elFinder/wiki/Connector-configuration-options-2.1#root-options
	|
	 */
	'root_options' => array(

	),

);
