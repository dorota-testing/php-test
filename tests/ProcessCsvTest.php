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

        //check five lines file
        $arrCSVfive = $objProcessCsv->turnCsvIntoArrayOfLines('tests/testFiles/fiveLines.csv');
        $arrFiveLines = array('line one', 'line two', 'line three', 'line four', 'line five');
        $this->assertSame($arrCSVfive, $arrFiveLines);
    }
}
