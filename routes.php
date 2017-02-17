<?php 

return [

	'' => 'ThreadsController@index',

	'threads' => 'ThreadsController@index',

	// threads reply controller

	'thread/reply' => 'ThreadsController@reply',

	'thread/edit' => 'ThreadsController@edit',

	'thread/save' => 'ThreadsController@save',

	'thread/new' => 'ThreadsController@new',

	'thread/create' => 'ThreadsController@create',

	//authentication

	'register' => 'AuthController@register',

	'login' => 'AuthController@login',

	'logout' => 'AuthController@logout',
];
