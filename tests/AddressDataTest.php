<?php

namespace Intredo\OrderConnector;

use PHPUnit\Framework\TestCase;

class AddressDataTest extends TestCase
{

    public function testAddressShouldBeCapableOfBeingJsonEncoded()
    {
        $addressData = new AddressData();
        $addressData->setName('test');
        $this->assertEquals('{"name":"test"}', json_encode($addressData));
    }
}
