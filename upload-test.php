<?php

   include 'config.php';
   $collection = $db->song;
  // echo "Collection selected succsessfully";

   $song=time() . '.' . pathinfo($_FILES['song']['name'], PATHINFO_EXTENSION);

   $song_data=upload($song);

if($song_data==1){
   $document = array(
      "name" => $_POST['name'],
      "album" => $_POST['album'],
      "singer" => $_POST['singer'],
      "song" => $song
   );

  $result = $collection->insertOne($document);
  if(isset($result)){
   echo "Document inserted successfully";
 }
}
elseif($song_data==2){ echo "upload error" ;}




 function upload($file)
 {

     if (!empty($file)) {
         $target_dir = 'music_target/';
         $thumb_dir  = 'music/';
         if (file_exists($target_dir)) {
             $target_dir = 'music_target/';
             $thumb_dir  = 'music/';
         } else {
             mkdir($target_dir, 0777, true);
             mkdir($thumb_dir, 0777, true);
         }
         $target_file = $target_dir . $file;
         $FileType    = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
         if ($FileType == 'mp3' || $FileType == 'm4a' ||  $FileType == 'wav') {
             $upload = 0;
          //   $url  = $thumb_dir . $file;
             if (move_uploaded_file($_FILES["song"]["tmp_name"], $target_file)) {
                 //unlink($target_file);
                 //unlink('users_thumbs/' . $old_file);
                // uploaded
                 return 1;

             } else {
               //could no upload
                 return 2;

             }
         }
         else {
           //Incompatible format error
           return 3 ;

         }
     }
 }
?>
