<?php 
use illuminate\collections;
use Illuminate\Support\Collection;

require __DIR__."../vendor/autpload.php";
$myArray=new Collection([1,2,3,4,5,6,7]);
if($myArray->contains(7)){
    return "find";
}