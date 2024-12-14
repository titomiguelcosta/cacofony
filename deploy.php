<?php

namespace Deployer;

require 'recipe/symfony.php';

set('repository', 'git@github.com:titomiguelcosta/cacofony.git');

add('shared_files', ['.env.local']);
set('git_tty', false);
set('keep_releases', 1);
set('writable_mode', 'acl');
set('composer_options', '--prefer-dist --no-progress --no-interaction --optimize-autoloader');

task('docker:restart', function () {
    run('cd {{current_path}} && docker compose -f docker-compose.yaml up -d', ['timeout' => null]);
});

host('cacofony.titomiguelcosta.com')
    ->set('remote_user', 'ubuntu')
    ->set('branch', 'main')
    ->set('deploy_path', '/mnt/websites/cacofony')
    ->set('env', [
        'SERVER_NAME' => ':8333',
        'APP_LOG_DIR' => '/tmp/cacofony/logs',
        'RELEASE_PATH' => '/mnt/websites/cacofony/current'
    ]);

after('deploy:failed', 'deploy:unlock');
after('deploy:symlink', 'docker:restart');
