<?php
require dirname(__DIR__) . '/src/protocol.php';

class zipTest extends PHPUnit_Framework_TestCase
{

    public function __construct()
    {
        $this->protocol = new \docup\Zip();
    }

    public function testCreate()
    {
        $this->protocol->create(__DIR__ . '/zip');
        $real = base64_encode(file_get_contents(__DIR__ . '/tmp.zip'));
        @unlink(__DIR__ . '/tmp.zip');
    }
}