<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'doctorproffi');

// Project repository
set('repository', 'https://github.com/timurlatypov/dp.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Shared files/dirs between deploys
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server
add('writable_dirs', []);


// Hosts
set('default_stage', 'staging');
set('branch', 'master');

host('94.142.139.93')
	->user('deployer')
	->identityFile('~/.ssh/deployer')
	->set('deploy_path', '/var/www/html/laravel')
	->set('master', 'master')
	->stage('production');


host('194.67.213.95')
	->user('deployer')
	->identityFile('~/.ssh/id_rsa_doctorproffi')
	->set('deploy_path', '/var/www/html')
	->set('master', 'master')
	->stage('staging');


set('composer_options', '{{composer_action}} --verbose --prefer-dist --no-progress --no-interaction --no-dev --optimize-autoloader --no-scripts');
set('keep_releases', 15);
set('cleanup_use_sudo', true);


// Tasks

task('build', function () {
	run('cd {{release_path}} && build');
});

desc('Composer dump autoload');
task('composer:dump:autoload', function () {
	run('cd {{release_path}} && composer dump-autoload');
});

task('reload:php-fpm', function () {
	run('sudo service php7.2-fpm restart');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.
// before('deploy:symlink', 'artisan:migrate');

