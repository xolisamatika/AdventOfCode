<?php

namespace Day25\TuringMachine;

class Rule
{
    private $expectedValue;
    private $writeValue;
    private $move;
    private $nextStateChar;

    public function __construct($expectedValue){
        $this->expectedValue = $expectedValue;
    }

    public function setWriteValue($writeValue) {
        $this->writeValue = $writeValue;
    }

    public function getWriteValue() {
        return $this->writeValue;
    }

    public function setMove($move) {
        $this->move = $move;
    }

    public function getMove() {
        return $this->move;
    }

    public function setNextStateChar($nextStateChar) {
        $this->nextStateChar = $nextStateChar;
    }

    public function getNextStateChar() {
        return $this->nextStateChar;
    }

    public function getExpectedValue() {
        return $this->expectedValue;
    }

    public function run($tape, $cursor)
    {
        $tape[$cursor] = $this->getWriteValue();
        $cursor = $cursor + $this->getMove();
        return array("tape" => $tape, "cursor" => $cursor, "nextState" => $this->getNextStateChar());
    }
}