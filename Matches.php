<?php


include_once('File.php');

class Matches extends File{
    //protected $input;
    private $finalArr;

    function __construct() {
        parent::__construct('text.txt');
        $this->storeAllMatchesIntoArray($this->arr, $this->input);

    }
    public function getfinalArr(){

        return $this->finalArr;
    }
    private function getStartMatch($value, $lenght, $withoutNumber)
    {
        if (substr($withoutNumber, 0, 1) === '.') {
            $valuewithoutdot = substr($withoutNumber, 1);
            $partOfValue = substr($this->input, 0, $lenght);
            if ($partOfValue === $valuewithoutdot) {
                $replaced = preg_replace('/' . $partOfValue . '/', $value, $this->input);
                $replaced = substr($replaced, 1);
                return $replaced;
            }
        }
    }
    private function getMiddleMatch($value, $lenght, $withoutNumber)
    {
        $elementFrom = stripos($this->input, $withoutNumber);
        $partOfValue = substr($this->input, $elementFrom, $lenght + 1);
        if ($elementFrom !== false) {
            $replaced = preg_replace('/' . $partOfValue . '/', $value, $this->input);
            return $replaced;
        }
    }
    private function getEndMatch($value, $lenght, $withoutNumber)
    {
        if (substr($withoutNumber, $lenght, 1) === '.') {
            $valuewithoutdot = substr($withoutNumber, 0, -1);
            $partOfValue = substr($this->input, -$lenght);
            $match = substr($this->input, -$lenght) === $valuewithoutdot;
            if ($partOfValue === $valuewithoutdot) {
                $replaced = preg_replace('/' . $partOfValue . '/', $value, $this->input);
                $replaced = substr($replaced, 0, -1);
                return $replaced;
            }
        }
    }
    private function storeAllMatchesIntoArray($valuesFromText, $input)
    {


        $finalArr = array();

        foreach ($valuesFromText as $value) {
            $withoutNumber = preg_replace('/[0-9]+/', '', $value);
            $lenght = strlen($withoutNumber) - 1;
            $getStartMatch = $this->getStartMatch($value, $lenght, $withoutNumber);
            if($getStartMatch != ""){
                array_push($finalArr, $getStartMatch);
            }
            $getMiddleMatch = $this->getMiddleMatch($value, $lenght, $withoutNumber);
            if($getMiddleMatch != ""){
                array_push($finalArr, $getMiddleMatch);
            }
            $getEndMatch = $this->getEndMatch($value, $lenght, $withoutNumber);
            if($getEndMatch != ""){
                array_push($finalArr, $getEndMatch);
            }


        }
        $this->finalArr = $finalArr;
    }
}