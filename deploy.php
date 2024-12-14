<?php

namespace Deployer;

require 'recipe/symfony.php';

set('repository', 'git@github.com:titomiguelcosta/cacofony.git');

add('shared_files', ['.env.local']);
set('git_tty', false);
set('keep_releases', 1);
set('writable_mode', 'acl');
set('composer_options', '--prefer-dist --no-progress --no-interaction --optimize-autoloader');

task('frontend:build', function () {
    run('cd {{release_path}} && npm install', ['timeout' => null]);
    run('cd {{release_path}} && npm run build', ['timeout' => null]);
});

host('cacofony.titomiguelcosta.com')
    ->set('remote_user', 'ubuntu')
    ->set('branch', 'master')
    ->set('deploy_path', '/mnt/websites/cacofony')
    ->set('env', ['PATH' => '/usr/local/bin:/usr/bin:/bin:/mnt/websites/.ubuntu/.nvm/versions/node/v20.0.0/bin']);

after('deploy:failed', 'deploy:unlock');

