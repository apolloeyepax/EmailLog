<?php

    namespace DevEyepax\EmailLog;

    use Carbon\Carbon;
    use Illuminate\Support\Facades\DB;
    use League\Flysystem\Config;

    class EmailLog {

        /**
         *
         * Log the values of emails to the database using this function
         *
         * @param null $receiverMail
         * @param null $subject
         * @param null $body
         * @param null $attachments
         * @return bool
         */
        public static function log($receiverMail = null, $subject = null, $body = null, $attachments = null) {

            $data = [
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ];

            try {
                if (config('email_log.columns.sent_email_address') == 1) {
                    $data['sent_email_address'] = $receiverMail;
                }
                if (config('email_log.columns.subject') == 1) {
                    $data['subject'] = $subject;
                }
                if (config('email_log.columns.body') == 1) {
                    $data['body'] = serialize($body);
                }
                if (config('email_log.columns.attachments') == 1) {
                    $data['attachments'] = $attachments;
                }

                return \DB::table(config('email_log.table_name'))->insert($data);
            } catch (\Exception $ex) {
                return false;
            }
        }

        /**
         * Get log values from the table
         *
         * @param array $params
         * @param int $page
         * @param int $itemsPerPage
         * @return mixed
         */
        public static function getLogs($params = [], $page = 1, $itemsPerPage = 20) {
            $offset = ($page - 1) * $itemsPerPage;
            $query = DB::table(config('email_log.table_name'));

            if ($params) {
                foreach ($params as $key => $value) {
                    if ($key == 'after') {
                        $query = $query->where('created_at', '>=', $value);
                    } else {
                        if ($key == 'before') {
                            $query = $query->where('created_at', '<=', $value);
                        } else {
                            $query = $query->where($key, $value);
                        }
                    }
                }
            }

            $results = $query->skip($offset)->take($itemsPerPage)->get();

            return $results;

        }

        /**
         * Get logs related to a specific ID
         *
         * @param null $logId
         * @return null
         */
        public static function getLogDetails($logId = null) {
            $details = null;

            if ($logId) {
                $details = DB::table(config('email_log.table_name'))->find($logId);
            }

            return $details;
        }
    }