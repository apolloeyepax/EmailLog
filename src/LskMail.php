<?php

    namespace DevEyepax\EmailLog;

    use Illuminate\Bus\Queueable;
    use Illuminate\Mail\Mailable;
    use Illuminate\Queue\SerializesModels;
    use Illuminate\Contracts\Queue\ShouldQueue;

    class LskMail extends Mailable {
        use Queueable, SerializesModels;

        /**
         * Create a new message instance.
         *
         * @return void
         */
        protected $value;
        protected $template;
        protected $attachment;
        public $subject;

        public function __construct($template, $array, $subject, $attachment = '') {
            $this->value = $array;
            $this->template = $template;
            $this->subject = $subject;
            $this->attachment = $attachment;
        }

        /**
         * Build the message.
         *
         * @return $this
         */
        public function build() {
            $message = $this->view($this->template)
                ->with($this->value)
                ->subject($this->subject);
            if ($this->attachment != '') {
                $message->attach($this->attachment);
            }
        }
    }
