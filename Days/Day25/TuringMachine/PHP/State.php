<?php

namespace Day25\TuringMachine;

class State
    {
        private $name;
        private $rules;

        public function __construct($name, $rules = array()){
            $this->name = $name;
            $this->rules = $rules;
        }

        public function addRule($rule) {
            $this->rules[$rule->getExpectedValue()] = $rule;
        }

        public function getRule($currentValue) {
            return $this->rules[$currentValue];
        }

        
        public function run($tape, $cursor)
        {
            if(!isset($tape[$cursor])){
                $tape[$cursor] = 0;
            }
            $rule = $this->getRule($tape[$cursor]);
            return $rule->run($tape, $cursor);
        }
    }