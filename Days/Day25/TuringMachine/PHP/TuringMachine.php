<?php
    namespace Day25\TuringMachine;

    require('State.php'); 
    require('Rule.php'); 

    use Day25\TuringMachine\State;
    use Day25\TuringMachine\Rule;

    class TuringMachine
    {
        private $tape;
        private $cursor;
        private $states;
        private $currentStateChar;
        private $steps;

        public function __construct($inputFilePath = "") {
            if ($inputFilePath == null) {
                $inputFilePath = dirname(__FILE__) ."/../puzzle_input.txt";
            }
            $inputFile = fopen($inputFilePath, "r") or die("Unable to open file!");
            $this->extractFileContent($inputFile);
            fclose($inputFile);

        }

        private function getChar($words) {
            $lineSize = count($words);
            return substr($words[$lineSize-1],0, 1);
        }

        private function extractFileContent($inputFile)
        {
            while(!feof($inputFile)) {
                $line = fgets($inputFile);
                $words = explode(" ", trim($line));
                switch (trim($words[0])) {
                    case "In":
                        unset($state);
                        $stateChar = $this->getChar($words);
                        // echo "stateChar : ".  $stateChar."\n";
                        $state = new State($stateChar);
                        $this->states[$stateChar] = $state;
                        break;
                    case "If":
                        unset($rule);
                        $expectedValue = $this->getChar($words);
                        // echo "expectedValue : ". $expectedValue."\n";
                        $rule = new Rule($expectedValue);
                        $state->addRule($rule);
                        break;
                    case "-":
                    
                        $ruleChar = $this->getChar($words);
                        // echo "ruleChar : ".  $ruleChar ."\n";
                        if ($words[1] == "Write") {
                            $rule->setWriteValue($ruleChar);
                        }
                        if ($words[1] == "Move") {
                            $moveValue = $ruleChar == "r" ? 1 : -1;
                            $rule->setMove($moveValue);
                        }
                        if ($words[1] == "Continue") {
                            $rule->setNextStateChar($ruleChar);
                        }
                        break;
                    case "Begin":
                        $this->currentStateChar = $this->getChar($words);
                        // echo "currentStateChar : ". $this->currentStateChar."\n";
                        break;
                    case "Perform":
                        $lineSize = count($words);
                        $this->steps = $words[$lineSize-2];
                        // echo "steps : ". $this->steps ."\n";
                        break;
                    default:
                        # code...
                        break;
                }
              }
        }

        public function execute()
        {
            $stringTape = "0 0 0 0 0 0";
            $this->cursor = rand(0,  5);
            $this->tape = \explode(" ", $stringTape);
            
            $this->printTape($this->tape, $this->cursor, 0, $this->currentStateChar);
       
            for ($i=1; $i <= $this->steps; $i++) {
                $this->curruntState = $this->states[$this->currentStateChar];
                $result = $this->curruntState->run($this->tape, $this->cursor);
                $this->tape = $result['tape'];
                $this->cursor = $result['cursor'];
                $this->currentStateChar = $result['nextState'];
                // $this->printTape($this->tape, $this->cursor, $i, $this->currentStateChar);
            }
         
            $count = 0;
            foreach ($this->tape as $value) {
                if ($value === '1') {
                    $count++;
                }
            }
            echo $count;
        }
        
        public function printTape($tape, $cursor, $step, $stateChar) 
        {   
            $printString = "...";
            foreach ($tape as $key => $value) {
                if ($cursor == $key) {
                   $printString =  $printString. " [$value] ";
                } else {
                    $printString =  $printString. " $value ";
                }
            }
            $printString =  $printString. "...";
            $str = $step == 0 ? "(before any steps;" : "(after $step step;";
            $printString =  $printString. $str . " about to run state $stateChar)"; 

            echo  $printString."\n";
        }
    }
   $t =  new TuringMachine();
   $t->execute();