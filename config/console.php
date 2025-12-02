<?php return array (
  'version' => '1.0.0',
  'pathRepository' => __DIR__ . '/../',
  'commands' =>
  array (
    0 =>
    array (
      'name' => 'serve',
      'description' => 'Start the development server',
      'class' => 'MT\\Console\\Commands\\ServeCommand',
    ),
    1 =>
    array (
      'name' => 'migrate',
      'description' => 'Run database migrations',
      'class' => 'MT\\Console\\Commands\\MigrateCommand',
    ),
    2 =>
    array (
      'name' => 'seed',
      'description' => 'Seed the database with data',
      'class' => 'MT\\Console\\Commands\\SeedCommand',
    ),
    3 =>
    array (
      'name' => 'make:controller',
      'description' => 'Create a new controller',
      'class' => 'MT\\Console\\Commands\\MakeControllerCommand',
    ),
  ),
);
