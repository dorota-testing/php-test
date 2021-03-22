<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Src\ProcessCsv;

class ProcessCsvTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->assertTrue(true);
    }

    public function testSayHello()
    {
        $objProcessCsv = new ProcessCsv();
        $hello = $objProcessCsv->sayHello();

        $this->assertTrue($hello === 'Hello');
    }
}
