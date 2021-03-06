<?php

namespace Src;

class ProcessCsv
{
  /**
   *  @return array This returns array of lines of selected csv file
   *  @param string - path to the csv file (including file name)
   */
  public function turnCsvIntoArrayOfLines($csv_path)
  {
    $arrReturn = [];
    $file = new \SplFileObject($csv_path, "r");
    $n = 0;
    while (!$file->eof()) {
      $n++;
      // this returns line as array
      $arrLine = $file->fgetcsv();
      //this turns array to string and removes trailing whitespace
      $strLine = trim(implode(' ', $arrLine));
      //this skips empty lines
      if ($strLine != '' && $n !== 1) {
        $arrReturn[] = $strLine;
      }
    }
    return $arrReturn;
  }

  /**
   *  @return array This returns array of person's data (keys: title, first_name, initial, last_name)
   *  @param string - string with person's data. Expected to have at least two words. First is expected to be a title, lats to be a surname. If there is third word in the middle it has to be a forename (can be full or and initial).
   */
  public function splitStringIntoPersonArray($string)
  {
    $arrReturn = [];
    $arrExplode = explode(' ', $string);
    //this is for three words in string
    if (count($arrExplode) == 3) {
      $title = $arrExplode[0];
      $last_name = $arrExplode[2];
      $first_name = null;
      $initial = null;
      //remove dot form middle word
      $middle = str_replace(".", "", $arrExplode[1]);
      if (strlen($middle) == 1) {
        $initial = $middle;
      } else {
        $first_name = $middle;
      }
      $arrReturn = [
        "title" => $title,
        "first_name" => $first_name,
        "initial" => $initial,
        "last_name" => $last_name
      ];
    }
    //this is for two words in string
    if (count($arrExplode) == 2) {
      $arrReturn = [
        "title" => $arrExplode[0],
        "first_name" => null,
        "initial" => null,
        "last_name" => $arrExplode[1]
      ];
    }

    return $arrReturn;
  }

  /**
   *  @return array This returns array of two strings, each being one person string
   *  @param string - string with two person's data. Expected to contain word 'and' or '&'
   */
  public function splitStringIntoTwoPersons($string)
  {
    $arrReturn = [];
    $arrExplode = explode(' ', $string);
    //check where the position of 'and'
    $key = array_search('and', $arrExplode);
    if ($key == 0) {
      $key = array_search('&', $arrExplode);
    }
    //case when 'and' is between titles
    if ($key == 1) {
      $title1 = $arrExplode[0];
      $title2 = $arrExplode[2];
      //case with husband's forename
      if (isset($arrExplode[4])) {
        $first_name = $arrExplode[3];
        $last_name = $arrExplode[4];
        $arrReturn = [
          trim($title1 . ' ' . $first_name . ' ' . $last_name),
          trim($title2 . ' ' . $last_name)
        ];
      } else { // case with only surname
        $last_name = $arrExplode[3];
        $arrReturn = [
          trim($title1 . ' ' . $last_name),
          trim($title2 . ' ' . $last_name)
        ];
      }
    }
    //case when 'and' is between people
    if ($key > 1) {
      $arrPeople = explode($arrExplode[$key], $string);
      $arrReturn = [trim($arrPeople[0]), trim($arrPeople[1])];
    }
    return $arrReturn;
  }

  /**
   *  @return bool This true if string is two people and false if one
   *  @param string - a string containing one or two people
   */
  public function detectTwoPersons(string $string)
  {
    //check if contains 'and' or &
    $arrExplode = explode(' ', $string);
    $detected1 = in_array('and', $arrExplode);
    $detected2 = in_array('&', $arrExplode);
    if ($detected1 === true || $detected2 === true) {
      return true;
    } else {
      return false;
    }
  }

  /**
   *  @return array This returns array of arrays containing people's data
   *  @param string - path to the csv file (including file name)
   */
  public function processCsvFile(string $csv_path)
  {
    $arrReturn = [];
    // get lines of the csv file
    $arrCsv = $this->turnCsvIntoArrayOfLines($csv_path);
    // process lines
    foreach ($arrCsv as $line) {
      // detect two people in line
      $two = $this->detectTwoPersons($line);
      if ($two) {
        $arrTwo = $this->splitStringIntoTwoPersons($line);
        foreach ($arrTwo as $person) {
          $arrReturn[] = $this->splitStringIntoPersonArray($person);
        }
      } else {
        $arrReturn[] = $this->splitStringIntoPersonArray($line);
      }
    }
    return $arrReturn;
  }
}
