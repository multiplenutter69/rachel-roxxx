<?php

/**
 * Interface template for collection services
 * @author Stefan
 */
interface IStefanCollection {

    public function add($element);

    public function get($element);
    
    public function getAll();

    public function getFirst($amount);

    public function getLast();

    public function rem($index);

    public function length();

    public function orderBy($criteria);
}
