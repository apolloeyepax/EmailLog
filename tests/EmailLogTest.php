<?php

    use PHPUnit\Framework\TestCase;
    use Eyepax\EmailLog\EmailLog;

    /**
     * Created by PhpStorm.
     * User: Buwaneka.Kalansuriya
     * Date: 8/24/2017
     * Time: 6:15 PM
     */
    class EmailLogTest extends TestCase{
        private $request;
        private $carbon;
        private $config;
        private $db;

        public function setUp()
        {

            parent::setUp();
            $this->request = Mockery::mock('alias:Request');
            $this->carbon = Mockery::mock('alias:Carbon\Carbon');
            $this->db = Mockery::mock('alias:DB');

            $this->carbon->shouldReceive("now")
                ->andReturn($this->carbon)
                ->shouldReceive('toDateTimeString')
                ->andReturn('2017-08-16 12:51:00');
        }

        public function tearDown()
        {
            Mockery::close();
        }

        public function testSingleLogAddSuccess()
        {
            $this->db->shouldReceive('table')
                ->andReturn($this->db)
                ->shouldReceive('insert')
                ->andReturn(true);
            $data = [
                'action_data' => []
            ];
            $activityLog = EmailLog::log($data);
            $this->assertTrue($activityLog);
        }

    }