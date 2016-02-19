<?php
/**
 *
 * @author Cesar Cappetto 
 */
interface IModel {
    
    public function insert($object);
    
    public function update($object, $criteria);
    
    public function delete($object, $criteria);
}
