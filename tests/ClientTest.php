<?php

use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    public function testInstantiation()
    {
        $client = new \aihomelessman\Core();
        $this->assertNotNull($client);
    }
}