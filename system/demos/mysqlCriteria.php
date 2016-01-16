<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once ("../../system/criteria/MySqlCriteria.php");

$c = new MySqlCriteria();

$c->equal("name", "john");
$c->andConectr();
$c->isNull("birthdate");
$c->orderByAsc("name","age");
$c->limit(1);

echo $c->getCriteria();