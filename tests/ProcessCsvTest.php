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

    /**
     * This sets data for next test
     */
    public function getPersonStrings()
    {
        return [
            [
                'Mr John Smith', [
                    'title' => 'Mr',
                    'first_name' => 'John',
                    'initial' => null,
                    'last_name' => 'Smith'
                ]
            ],
            [
                'Mr J. Smith', [
                    'title' => 'Mr',
                    'first_name' => null,
                    'initial' => 'J',
                    'last_name' => 'Smith'
                ]
            ],
            [
                'Mr Smith', [
                    'title' => 'Mr',
                    'first_name' => null,
                    'initial' => null,
                    'last_name' => 'Smith'
                ]
            ]
        ];
    }
    /**
     * @dataProvider getPersonStrings
     */
    public function testSplitStringIntoPersonArray(string $string, array $arrResult)
    {
        $objProcessCsv = new ProcessCsv();
        $arrSplit = $objProcessCsv->splitStringIntoPersonArray($string);

        $this->assertSame($arrSplit, $arrResult);
    }

    /**
     * This sets data for next test
     */
    public function getTwoPersonstrings()
    {
        return [
            [
                'Mr and Mrs Smith', ['Mr Smith', 'Mrs Smith']
            ],
            [
                'Mr Tom Staff and Mr John Doe', ['Mr Tom Staff', 'Mr John Doe']
            ]
        ];
    }
    /**
     * @dataProvider getTwoPersonstrings
     */
    public function testSplitStringIntoTwoPersons(string $string, array $arrResult)
    {
        $objProcessCsv = new ProcessCsv();
        $arrSplitMultiple = $objProcessCsv->splitStringIntoTwoPersons($string);

        $this->assertSame($arrSplitMultiple, $arrResult);
    }

    /**
     * This sets data for next test
     */
    public function getCsvFileLine()
    {
        return [
            [
                'Mr and Mrs Smith', true
            ],
            [
                'Mr Tom Staff and Mr John Doe', true
            ],
            [
                'Mr John Smith', false
            ],
            [
                'Mr J. Smith', false
            ]
        ];
    }
    /**
     * @dataProvider getCsvFileLine
     */
    public function testDetectTwoPersons(string $string, bool $result)
    {
        $objProcessCsv = new ProcessCsv();
        $detected = $objProcessCsv->detectTwoPersons($string);
        $this->assertSame($detected, $result);
    }

    public function testProcessCsvFile()
    {
        $arrIntendedResult = [
            [
                'title' => 'Mr',
                'first_name' => 'Bob',
                'initial' => null,
                'last_name' => 'Lawblaw'
            ],
            [
                'title' => 'Mr',
                'first_name' => null,
                'initial' => null,
                'last_name' => 'Smith'
            ],
            [
                'title' => 'Mrs',
                'first_name' => null,
                'initial' => null,
                'last_name' => 'Smith'
            ],
            [
                'title' => 'Dr',
                'first_name' => 'Joe',
                'initial' => null,
                'last_name' => 'Bloggs'
            ],
            [
                'title' => 'Mrs',
                'first_name' => null,
                'initial' => null,
                'last_name' => 'Bloggs'
            ]
        ];

        $objProcessCsv = new ProcessCsv();
        $processed = $objProcessCsv->processCsvFile('tests/testFiles/peopleSample.csv');
        $this->assertSame($processed, $arrIntendedResult);
    }
}
