<?php

    namespace DevEyepax\EmailLog;

    use Illuminate\Support\ServiceProvider;

    class EmailLogServiceProvider extends ServiceProvider {
        /**
         * Bootstrap the application services.
         *
         * @return void
         */
        public function boot() {
            $this->publishes([
                __DIR__ . '/config/email_log.php' => config_path('email_log.php')
            ]);
            $this->publishes([
                __DIR__ . '/2017_08_22_123534_create_trn_email_log_table.php' => database_path('migrations') .
                    '/2017_08_22_123534_create_trn_email_log_table.php'
            ]);
        }

        /**
         * Register the application services.
         *
         * @return void
         */
        public function register() {
            $this->app->make('DevEyepax\EmailLog\MailHelper');
            $this->app->singleton(EmailLog::class, function () {
                return new EmailLog();
            });
            $this->app->alias(EmailLog::class, 'email-log-package');
            $this->mergeConfigFrom(
                __DIR__ . '/config/email_log.php', 'email_log'
            );

        }
    }
