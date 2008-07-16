<?php

	$admin = '/'.Configure::read('Routing.admin');

	// Controller routing.
	Router::connect('/users/permissions', array('plugin'=>'user', 'controller' => 'permissions'));
	Router::connect('/users/groups', array('plugin'=>'user', 'controller' => 'groups'));
	Router::connect('/users', array('plugin'=>'user', 'controller' => 'users', 'action' => 'index'));
	
	// Admin routing
	Router::connect($admin.'/users/view/*', array('plugin'=>'user', 'controller' => 'users', 'admin' => true, 'action' => 'edit'));
	Router::connect($admin.'/users/edit/*', array('plugin'=>'user', 'controller' => 'users', 'admin' => true, 'action' => 'edit'));
	Router::connect($admin.'/users/*', array('plugin'=>'user', 'controller' => 'users', 'admin' => true));
	Router::connect($admin.'/users/groups', array('plugin'=>'user', 'controller' => 'groups', 'admin' => true));
	Router::connect($admin.'/users/permissions', array('plugin'=>'user', 'controller' => 'permissions', 'admin' => true));

	// User routes
	Router::connect('/login', array('plugin' => 'user', 'controller' => 'users', 'action' => 'login'));
	Router::connect('/logout', array('plugin' => 'user', 'controller' => 'users', 'action' => 'logout'));
	Router::connect('/forget', array('plugin' => 'user', 'controller' => 'users', 'action' => 'forget'));
	Router::connect('/register', array('plugin' => 'user', 'controller' => 'users', 'action' => 'register'));
	Router::connect('/activate/*', array('plugin' => 'user', 'controller' => 'users', 'action' => 'activate'));
	Router::connect('/reset/*', array('plugin' => 'user', 'controller' => 'users', 'action' => 'reset'));
	Router::connect('/profile', array('plugin' => 'user', 'controller' => 'users', 'action' => 'profile'));
?>