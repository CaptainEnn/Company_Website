<?php
Router::get('/register', 'AuthController@registerForm', ['requireGuest']);
Router::post('/register', 'AuthController@register', ['requireGuest']);
Router::get('/login', 'AuthController@loginForm', ['requireGuest']);
Router::post('/login', 'AuthController@login', ['requireGuest']);
Router::post('/logout', 'AuthController@logout', ['requireLogin']);
