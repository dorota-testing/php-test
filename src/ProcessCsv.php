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
    while (!$file->eof()) {
      // this returns line as array
      $arrLine = $file->fgetcsv();
      //this turns array to string and removes trailing whitespace
      $strLine = trim(implode(' ', $arrLine));
      //this skips empty lines
      if ($strLine != '') {
        $arrReturn[] = $strLine;
      }
    }
    return $arrReturn;
  }

  public function splitStringIntoPersonArray($string)
  {
    $arrReturn = [];

    return $arrReturn;
  }
}
