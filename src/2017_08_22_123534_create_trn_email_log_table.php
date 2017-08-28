<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateTrnEmailLogTable extends Migration {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up() {
            if (!Schema::hasTable(config('email_log.table_name'))) {
                Schema::create(config('email_log.table_name'), function (Blueprint $table) {
                    $table->increments('id');
                    if (config('email_log.columns.sent_email_address')) {
                        $table->text('sent_email_address')->default(null)->comment = "To email address";
                    }
                    if (config('email_log.columns.subject')) {
                        $table->text('subject')->default(null)->comment = "Email subject";
                    }
                    if (config('email_log.columns.body')) {
                        $table->mediumtext('body')->default(null)->comment = "Email body";
                    }
                    if (config('email_log.columns.attachments')) {
                        $table->text('attachments')->nullable()->default(null)->comment = "Attachment url";
                    }
                    $table->dateTime('created_at')->comment = "";
                    $table->dateTime('updated_at')->comment = "";
                });
            }
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down() {
            if (Schema::hasTable(config('email_log.table_name'))) {
                Schema::dropIfExists(config('email_log.table_name'));
            }
        }
    }
