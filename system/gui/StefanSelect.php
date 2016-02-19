<?php

/**
 * Name         : StefanSelect.php
 * Date         : Jan 2016
 * Version      : 
 * Author       : Stefan
 * Description  : Generates a <select> DOM
 * Notes        :
 */
require_once(SYSPATH . DS . "gui" . DS . "StefanControl.php");

class StefanSelect extends StefanControl {

    private $control = "";
    private $select = "";
    private $options = "";

    /**
     * Class constructor
     * @param array $param Configuration Array. Every element in the 
     * configuration array is a key value element where the key represents the
     * html tag and the value the value that the tag will take
     */
    public function __construct($param = array()) {
        $this->select = "<select ";
        foreach ($param as $k => $v) {
            $this->select .= $k . "='" . $v . "' ";
        }
        $this->select .= ">";
        $this->conect();
    }

    /**
     * Loads the data on the select
     * @param IStefanCollection $collection 
     * @param string $valueMethod The name of the method that will return the 
     * value to be used on the value tag
     * @param string $textMethod The name of the method that will return the 
     * text to be used on the text of the select
     */
    public function setData($collection = null, $valueMethod = "", $textMethod = "") {

        $resultValue = "";
        $resultText = "";

        foreach ($collection->getAll() as $obj) {
            $resultValue = call_user_func(array($obj, $valueMethod));
            $resultText = call_user_func(array($obj, $textMethod));
            $this->options .= "<option value=" . $resultValue . ">" . $resultText . "</option>";
        }
        
        $this->conect();
    }
    
    /**
     * Performs the display of the DOM element. Makes an echo of the html string
     * that comprises the element
     */
    public function display() {
        echo $this->control;
    }

    /**
     * Returns the html string that comprises the element
     * @return string The DOM string
     */
    public function getControl() {
        return $this->control;
    }
    
    /**
     * Performs the conection of all the parts (strings) that compose the
     * DOM element 
     */
    protected function conect(){
        $this->control = $this->select . $this->options . "</select>";
    }

}
