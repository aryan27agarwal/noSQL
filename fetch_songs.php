<?php
include 'config.php';
$collection = $db->song ;
$cursor = $collection->find();
$all_songs = $cursor->toArray() ;
//print_r($arr);
return $all_songs ;
 ?>
