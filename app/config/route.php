<?php

$config['route']['get'] = [
  '/style/(:any)/'          => 'document@document@style',
  '/script/(:any)/'         => 'document@document@script',
  '/library/(:any)/'        => 'document@document@library',
  '/fonts/(:any)/'          => 'document@document@font',
  '/image/(:any)/'          => 'document@document@image',
  '/api/v1/task'            => 'actions@actions@tasks',
  '/api/v1/task/(:any)'     => 'actions@actions@task',
  '/api/v1/count'           => 'actions@actions@taskcount',
  '/api/v1/page'            => 'actions@actions@taskpage',
  '/api/v1/page/(:any)'     => 'actions@actions@taskpage',
  '/api/v1/search'          => 'actions@actions@search',
  '/api/v1/search/(:any)'   => 'actions@actions@search',
  '/register'               => 'main@index',
  '/dashboard'              => 'main@index',
  '/crud'                   => 'main@index'
];

$config['route']['post'] = [
  '/api/activation'     =>  'actions@actions@activation',
  '/api/authorization'  =>  'actions@actions@authorization',
  '/api/registration'   =>  'actions@actions@registration',
  '/api/logout'         =>  'actions@actions@logout'
];