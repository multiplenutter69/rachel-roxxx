<?php
/**
 * Interface template for relational database criteria services
 * @author Stefan
 */
interface IStefanCriteria {

    public function equal($field, $value);

    public function more($field, $value);

    public function less($field, $value);

    public function moreEqual($field, $value);

    public function lessEqual($field, $value);

    public function isNull($field);

    public function isNotNull($field);

    public function limit();

    public function andConector();

    public function orConector();

    public function orderByAsc();

    public function orderByDesc();

    public function getCriteria();
}
