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
    ->set('deploy_path', '/var/www/doctorproffi/production')
    ->set('forward_agent', true)
    ->set('stage', 'production')
    ->set('identity_file', '~/.ssh/id_rsa')
    ->set('master', 'master');

// Hooks
after('deploy:failed', 'deploy:unlock');

// Clear OPcache by reloading PHP-FPM
task('phpfpm:reload', function () {
    run('sudo service php8.3-fpm reload');
})->desc('Clear OPcache by reloading PHP-FPM');

// Modify the deployment flow
after('deploy:symlink', 'phpfpm:reload');
