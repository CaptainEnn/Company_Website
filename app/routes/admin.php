<?php
Router::get('/admin', 'AdminUsersController@index', ['requireAdmin']);
Router::get('/admin/users', 'AdminUsersController@index', ['requireAdmin']);
Router::get('/admin/users/{id}', 'AdminUsersController@show', ['requireAdmin']);
Router::post('/admin/users/{id}/edit', 'AdminUsersController@edit', ['requireAdmin']);
Router::post('/admin/users/{id}/status', 'AdminUsersController@status', ['requireAdmin']);
Router::post('/admin/users/{id}/reset', 'AdminUsersController@reset', ['requireAdmin']);
Router::post('/admin/users/{id}/delete', 'AdminUsersController@delete', ['requireAdmin']);
