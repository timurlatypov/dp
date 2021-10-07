<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'doctorproffi');

// Project repository
set('repository', 'git@github.com:timurlatypov/dp.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Shared files/dirs between deploys
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server
add('writable_dirs', []);


// Hosts
set('default_stage', 'prod');
set('branch', 'master');

host('188.225.73.98')
	->user('root')
    ->forwardAgent()
	->identityFile('~/.ssh/id_rsa_doctorproffi_timeweb')
	->set('deploy_path', '/var/www/doctorproffi/production')
	->set('master', 'master')
	->stage('prod');

set('composer_options', '{{composer_action}} --verbose --prefer-dist --no-progress --no-interaction --no-dev --optimize-autoloader --no-scripts');
set('keep_releases', 15);
set('cleanup_use_sudo', true);

set('use_relative_symlink', false);

// Tasks

task('build', function () {
	run('cd {{release_path}} && build');
});

desc('Composer dump autoload');
task('composer:dump:autoload', function () {
	run('cd {{release_path}} && composer dump-autoload');
});

task('reload:php-fpm', function () {
	run('sudo service php8.0-fpm restart');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.
// before('deploy:symlink', 'artisan:migrate');

