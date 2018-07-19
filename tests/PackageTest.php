<?php

namespace Intredo\OrderConnector;

use PHPUnit\Framework\TestCase;

class PackageTest extends TestCase
{

    public function testJsonSerialize()
    {
        $package = new Package('SLR1');
        $package->addProduct(new Product('SLR'));
        $package->setCost('20.18');
        $this->assertEquals('{"code":"SLR1","qty":1,"cost":"20.18","products":[{"code":"SLR","qty":1}]}', json_encode($package));
    }
}
