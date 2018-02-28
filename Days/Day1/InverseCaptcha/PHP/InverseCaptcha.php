<?php
    namespace Day2\InverseCaptcha;

    class InverseCaptcha
    {
        private $digits;
        private $digitsCount;
        private $lastDigit;
        private $firstDigit;

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
            while(!feof($inputFile)) {
                $line = fgets($inputFile);
                $this->digits = $line;
                $this->digitsCount = \strlen($this->digits)-1;
                $this->lastDigit = $this->digits[$this->digitsCount];
                $this->firstDigit = $this->digits[0];
              }
        }

        public function run()
        {
            $sum = 0;
            $sum = $sum + $this->execute($this->digits, 0, $this->digitsCount);
            echo "sum : $sum";
        }

        public function execute($digits, $start, $end)
        {
            $lastDigit = $digits[$end];
            $firstDigit = $digits[$start];

            if ($this->isMatch($firstDigit, $lastDigit)) {
                $sum = $sum + $firstDigit;
            }

            for ($i=$start; $i < $end; $i++) { 
                if ($this->isMatch($digits[$i], $digits[$i+1])) {
                    $sum = $sum + $digits[$i];
                }
            }

            return $sum;
        }


        public function isMatch ($num1, $num2)
        {
            echo $num1 ."==". $num2 ."\n";
            return $num1 == $num2;
        }
    }
   $t =  new InverseCaptcha();
   $t->run();