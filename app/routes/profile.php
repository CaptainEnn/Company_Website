<?php
Router::get('/profile', 'ProfileController@index', ['requireLogin']);
Router::post('/profile/details', 'ProfileController@details', ['requireMember']);
Router::post('/profile/password', 'ProfileController@password', ['requireLogin']);
Router::post('/profile/avatar', 'ProfileController@avatar', ['requireMember']);
