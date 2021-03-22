<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Src\ProcessCsv;

class ProcessCsvTest extends TestCase
{
    public function testTurnCsvIntoArray()
    {
        $objDorota = new DorotasClass();

        //check empty
        $arrCSVempty = $objDorota->turnCsvIntoArrayOfLines('tests/testFiles/empty.csv');
        $emptyArr = array();
        $this->assertSame($arrCSVempty, $emptyArr);

    }
}
