<?php
// Route dùng chung. Mỗi module có file route riêng: app/routes/<module>.php
Router::get('/', 'HomeController@index');
