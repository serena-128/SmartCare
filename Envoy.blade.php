@servers(['web' => '101.101.101.101'])

@story('deploy')
    timestamp
    git-pull-code
    database-migrate
    composer-update
    node-update
    npm-run-prod
@endstory

@task('timestamp', ['on' => 'web'])
    echo '>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>'
    date
    echo '>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>'
@endtask

@task('git-pull-code',  ['on' => 'web'])
    cd `ls`
    rm -f composer.lock
    rm -f package-lock.json
    rm -f public/css/app.css
    rm -f public/js/app.js
    rm -f public/mix-manifest.json
    git pull origin main
@endtask

@task('database-migrate', ['on' => 'web'])
    cd `ls`
    php artisan migrate --force
@endtask

@task('composer-update', ['on' => 'web'])
    cd `ls`
    php composer.phar update --no-interaction --optimize-autoloader
@endtask

@task('node-update', ['on' => 'web'])
    cd `ls`
    source ~/.nvm/nvm.sh
    npm install
@endtask

@task('npm-run-prod', ['on' => 'web'])
    cd `ls`
    source ~/.nvm/nvm.sh
    npm run prod
@endtask
