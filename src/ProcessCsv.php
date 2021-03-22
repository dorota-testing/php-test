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
      if ($n === 1) {
        $arrColNames = $file->fgetcsv();
        $count = count($arrColNames);
      } else {
        $arrLine = $file->fgetcsv();
 
        // check if line not empty
        $implode = implode('', $arrLine);
        if (!empty($implode)) {
          // check if line fields match column names
          if (count($arrLine) === $count) {
            foreach ($arrColNames as $k => $colName) {
              $arr[$colName] = $arrLine[$k];
            }
            $arrReturn[] = $arr;
          }
        }
      }
    }

    return $arrReturn;
  }
}
