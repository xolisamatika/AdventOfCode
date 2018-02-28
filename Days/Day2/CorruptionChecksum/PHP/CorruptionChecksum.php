<?php
    namespace Day1\InverseCaptcha;

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
                $min = min($row);
                $max = max($row);

                echo "max: $max \n";
                echo "min: $min \n";
                $diff = $max - $min;
                $sum = $sum + $diff;
              }
              echo $sum;
        }

    }
   $t =  new InverseCaptcha();