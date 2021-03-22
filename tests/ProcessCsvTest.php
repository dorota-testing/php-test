<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Src\ProcessCsv;

class ProcessCsvTest extends TestCase
{
    public function testTurnCsvIntoArray()
    {
        $objProcessCsv = new ProcessCsv();

        //check empty
        $arrCSVempty = $objProcessCsv->turnCsvIntoArrayOfLines('tests/testFiles/empty.csv');
        $emptyArr = array();
        $this->assertSame($arrCSVempty, $emptyArr);

    }
}
