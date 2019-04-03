<?php
   // connect to mongodb
   // $m = new MongoClient();
   // echo "Connection to database successfully";
   //
   // // select a database
   // $db = $m->mydb;
   // echo "Database mydb selected";
   // $collection = $db->mycol;
   // echo "Collection selected succsessfully";
include 'config.php';
$collection = $db->song;
echo "Collection selected succsessfully";
   $document = array(
      "name" => $_POST['name'],
      "album" => $_POST['album'],
      "singer" => $_POST['singer'],
      "song" => $_POST['song']
   );

  $result = $collection->insertOne($document);
  if(isset($result)){
   echo "Document inserted successfully";
 }
?>
