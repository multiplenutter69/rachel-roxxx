<?php


/**
 * Abstract Class that provides all the generalized behavior that all
 * StefanControl elements shoud have
 */
abstract class StefanControl {

    /**
     * Loads the data on the Control
     */
    abstract public function setData();
    
     /**
     * Performs the display of the DOM element. Makes an echo of the html string
     * that comprises the element
     */
    abstract public function display();
    
    /**
     * Returns the html string that comprises the element
     */
    abstract public function getControl();

    /**
     * Performs the conection of all the parts (strings) that compose the
     * DOM element 
     */
    abstract protected function conect();
}
