<?php
    namespace Day1\InverseCaptcha2;

    class InverseCaptcha
    {
        public function __construct($inputFilePath = "") {
            if ($inputFilePath == null) {
                $inputFilePath = dirname(__FILE__) ."/../puzzle_input.txt";
            }
            $inputFile = fopen($inputFilePath, "r") or die("Unable to open file!");
            $this->extractFileContent($inputFile);
            fclose($inputFile);

        }

        private function extractFileContent($inputFile)
        {
            $sum = 0;
            while(!feof($inputFile)) {
                $line = fgets($inputFile);
                $row = array_map('intval', explode(' ', $line));

                for ($i=0; $i < count($row) ; $i++) { 
                    for ($j=$i+1; $j < count($row); $j++) { 
                        $x = $row[$i] / $row[$j];
                        echo "$row[$i]  and $row[$j]  = $x\n"  ;
                        // echo $row[$i] / $row[$j] ."\n"  ;
                       if ($row[$i] % $row[$j] == 0) {
                           echo "$row[$i]  and $row[$j] \n"  ;
                           $sum += $row[$i] / $row[$j];
                       }

                       if ($row[$j] % $row[$i] == 0) {
                        echo "$row[$j]  and $row[$i] \n"  ;
                        $sum += $row[$j] / $row[$i];
                    }
                    }
                }
                
            //     $diff = $max - $min;
            //     $sum = $sum + $diff;
              }
              echo $sum;
        }
    }
   $t =  new InverseCaptcha();