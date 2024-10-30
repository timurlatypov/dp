<?php
namespace Deployer;

require 'recipe/laravel.php';

// Config
set('application', 'doctorproffi');
set('repository', 'git@github.com:timurlatypov/dp.git');
set('keep_releases', 15);
set('git_tty', true);
set('cleanup_use_sudo', true);
set('use_relative_symlink', false);
set('default_stage', 'prod');
set('branch', 'master');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts

host('188.225.73.98')
    ->set('remote_user', 'root')
    ->set('port', 2222)
    ->set('deploy_path', '/var/www/doctorproffi/production')
    ->set('forward_agent', true)
    ->set('stage', 'production')
    ->set('identity_file', '~/.ssh/id_rsa')
    ->set('master', 'master');

// Hooks
after('deploy:failed', 'deploy:unlock');

// Modify the existing opcache:clear task
task('opcache:clear', function () {
    run('sudo service php8.3-fpm reload');
})->desc('Clear OPcache by reloading PHP-FPM');

// Add a new task to restart Nginx
task('supervisor:restart', function () {
    run('sudo supervisorctl restart laravel-worker:*');
})->desc('Restart Supervisor');

// Modify the deployment flow
after('deploy:symlink', 'opcache:clear');
after('opcache:clear', 'supervisor:restart');
