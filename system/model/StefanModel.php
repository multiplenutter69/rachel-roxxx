<?php

/**
 * Name         : StefanModel.php
 * Date         : Jan 2016
 * Version      : 
 * Author       : Stefan
 * Description  : 
 * Notes        :
 */
class StefanModel {

    /**
     * @var IStefanDriver
     */
    private $driver;

    /**
     * @var ISqlBuilder
     */
    private $qb;

    public function setDriver(IStefanDriver $driver) {
        $this->driver = $driver;
    }

    public function setSqlBuilder(ISqlBuilder $qb) {
        $this->qb = $qb;
    }

    public function save($obj, $exp = "") {
        $id = call_user_func(array($obj, "getId"));
        if (empty($id)) {
            $query = $this->qb->insert($obj);
        } else {
            $condition = Criteria::generateCondition($exp, $obj);
            $query = $this->qb->update($obj, $condition);
        }
        return $this->driver->executeNonQuery($query);
    }

    public function remove($obj, $exp) {
        $condition = Criteria::generateCondition($exp, $obj);
        $query = $this->qb->delete($obj, $condition);
        return $this->driver->executeNonQuery($query);
    }

    public function find($exp, $obj) {

        $fields = Criteria::generateFields($obj);
        $from = Criteria::generateTable($obj);
        $condition = Criteria::generateCondition($exp, $obj);

        $query = $this->qb->select($fields, $from, $condition);
        $op = $this->driver->executeQuery($query);

        if (empty($op)) {
            $result = null;
        } elseif (count($op) == 1) {
            $result = new $from();

            //Agregarle las propiedades set...
        } else {
            $result = new StefanList();
            foreach ($op as $o) {

                $tempObj = new $from();

                //Agregarle las propiedades set...

                $result->add($tempObj);
            }
        }

        return $result;
    }

    public function findOneToMay($exp, $obj, $matchExp) {
        
    }
    
    public function findManyToMany($exp, $obj, $matchExp){
        
    }

}
