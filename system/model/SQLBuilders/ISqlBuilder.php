<?php

interface ISqlBuilder {

    public function insert($obj, $filter);

    public function update($obj, $criteria, $filter);

    public function delete($obj, $criteria);

    public function select($fields, $from, $criteria);
}
