<?php
// require 'vendor/autoload.php';
// $collection = (new MongoDB\Client)->test->users;
//
// $insertOneResult = $collection->insertOne([
//     'username' => 'admin',
//     'email' => 'admin@example.com',
//     'name' => 'Admin User',
// ]);
//
// printf("Inserted %d document(s)\n", $insertOneResult->getInsertedCount());
//
// var_dump($insertOneResult->getInsertedId());

?>
<?php
/*************************************************************************/
/****** This file will be used in all files for connection to MongoDB ******/
require 'vendor/autoload.php' ;
$client = new MongoDB\Client("mongodb://localhost:27017");
/****** Database for the proect Selected here *******/
$db = $client->music ;
/****** Validating Client for connection  ******/
if($client == false){
  echo "MongoDB Connection Error" ;
}
/***************USE CASE FOR THE FIlE***********/
/********Choose Collection in main file********/
 /***********$collection = $db->news ***********/
 /********************************************/
 ?>
