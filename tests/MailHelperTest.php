<?php


    use PHPUnit\Framework\TestCase;
    use DevEyepax\EmailLog\MailHelper;

    /**
     * Created by PhpStorm.
     * User: Buwaneka.Kalansuriya
     * Date: 8/25/2017
     * Time: 7:58 PM
     */
    class MailHelperTest extends TestCase {
        private $mail;
        private $helper;


        public function setUp() {
            $this->mail = Mockery::mock('alias:Mail');
            $this->helper = Mockery::mock('alias:Helper');

            $this->mail->shouldReceive('to')
                ->andReturn(true)
                ->shouldReceive('cc')
                ->andReturn(true)
                ->shouldReceive('bcc')
                ->andReturn(true)
                ->shouldReceive('queue')
                ->andReturn(true);

        }

        public function tearDown() {
            Mockery::close();
        }

        public function testSuccessMail(MailHelper $helper) {
            $value = $helper->sendMail("test@eyepax.com", ['test1@eyepax.com'], ['test3@eyepax.com'], "Testing", 'test-body', 'test.email', 'location');
            $this->assertTrue($value);
        }

    }