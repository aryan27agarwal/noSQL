<?php
$i=0 ;
if(isset($_POST['submit'])){
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
  // echo "Document inserted successfully";
   $i = 1 ;
}else{
$i = 2 ;
/* error storing in db */}
}
elseif($song_data==2){ echo "upload error" ;}
}
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


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
@import url('https://fonts.googleapis.com/css?family=Open+Sans');
* {
  font-family: 'Open Sans';
}
body, html {
  height: 100%;
  font-family: Arial, Helvetica, sans-serif;
}

* {
  box-sizing: border-box;
}

.bg-img {
  /* The image used */
  background-image: url("work.jpeg");

  min-height: 600px;

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: contain;
  position: relative;
}

/* Add styles to the form container */
.container {
  position: absolute;
  right: 0;
  margin: 20px;
  max-width: 300px;
  padding: 16px;
  background-color: white;
}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit button */
.btn {
  background-color: #EF3078;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.btn:hover {
  opacity: 1;
}
</style>
<style>
.alert-success {
  padding: 20px;
  background-color: green;
  color: white;
}
.alert-error {
  padding: 20px;
  background-color: #f44336;
  color: white;
}
</style>
</head>
<body>

<h2>musiXmongo</h2>
<div class="bg-img">
  <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" class="container" enctype="multipart/form-data">
    <h1>Upload Song</h1>
    <?php
                       if($i==1){ echo'
                         <div class="alert-success">
   <strong> Song Uploaded Successfully</strong>
 </div>
';
                     }
                       if($i==2){ echo'
                         <div class="alert-error">
   <strong>Error Uploading</strong>
 </div>
';
                     //	echo "<script> alert($result); </script>";
                     } ?>

    <input type="text" placeholder="Enter Song Name" name="name" required>
    <input type="text" placeholder="Enter Album Name" name="album" required>
    <input type="text" placeholder="Enter Singer Name" name="singer" required>
    <label for="psw"><b>Uplaod Song (.mp3 format)</b></label> <br><br>
    <input type="file" placeholder="Enter Song Name" name="song" id="song"required>
    <br><br>
    <button type="submit" class="btn" name="submit">Done!</button>
  </form>
</div>
</body>
</html>
