<?php

    namespace DevEyepax\EmailLog;

    use DevEyepax\EmailLog\LskMail;
    use App\Http\Controllers\Controller;
    use Illuminate\Support\Facades\Mail;
    use DevEyepax\EmailLog\EmailLog;

    /**
     * Class MailHelper
     *
     * @package DevEyepax\EmailLog
     */
    class MailHelper extends Controller
    {
        private $helper;

        public function _construct(Helper $helper)
        {
            $this->helper = $helper;
        }

        /**
         * Call this function to send a mail to a user
         *
         * @param $email
         * @param array $cc
         * @param array $bcc
         * @param $subject
         * @param $body
         * @param $template
         * @param string $attachment
         * @return bool
         */
        public function sendMail($email = null, $cc = [], $bcc = [], $subject = null, $body = null, $template = null, $attachment = '')
        {
            try {
                $message = Mail::to($email);
                if ($cc != []) {
                    $message->cc($cc);
                }
                if ($bcc != []) {
                    $message->bcc($bcc);
                }
                
                if ($email != null && $body != null && $template != null) {
                    $message->queue(new LskMail($template, $body, $subject, $attachment));
                    EmailLog::log($email, $subject, $body, $attachment);

                    return true;
                } else {
                    return false;
                }

            } catch (\Exception $ex) {
                return false;
            }
        }


    }
