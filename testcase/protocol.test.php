<?php
require dirname(__DIR__) . '/src/protocol.php';

class protocolTest extends PHPUnit_Framework_TestCase
{

    public function __construct()
    {
        $this->protocol = new \docup\Protocol();
    }

    public function testCreateZipFile()
    {
        $this->protocol->createZipFile(__DIR__ . '/zip');
        //unlink(__DiR__ . '/tmp.zip');
    }
}