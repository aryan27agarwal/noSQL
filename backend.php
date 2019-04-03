<?php
session_start();
include_once "dbconnect.php";
$id = $_SESSION['id'];
if(isset($id)){
$sql2 = "SELECT * from gyms where gym_id = '$id'";
$result=$connect->query($sql2);
while($row=$result->fetch_assoc())
{
  // old pic data
  $old_file = $row['picture'];
}
$picture=time() . '.' . pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);
$pic_data=upload($picture);
if($pic_data==1) {
    $sql="UPDATE gyms set picture = '$picture' where gym_id='$id'";
     if($connect->query($sql)===true) {
                    echo 1;
}
}
if($pic_data == 3 ){
  //incomplatible data type
  echo 3 ;
}
if ($pic_data == 2) {
  //could not store image
  echo 2 ;
}
} //isset condition set
if ($old_file == '') {
  // deletion the file which already exists
    //unlink('users_thumbs/' . $old_file);
}
else {
  //do nothing
  unlink('users_thumbs/' . $old_file);
}
function upload($file)
{
    if (!empty($file)) {
        $target_dir = 'users_images/';
        $thumb_dir  = 'users_thumbs/';
        if (file_exists($target_dir)) {
            $target_dir = 'users_images/';
            $thumb_dir  = 'users_thumbs/';
        } else {
            mkdir($target_dir, 0777, true);
            mkdir($thumb_dir, 0777, true);
        }
        $target_file = $target_dir . $file;
        $FileType    = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if ($FileType == 'png' || $FileType == 'jpg' ||  $FileType == 'jpeg') {
            $upload = 0;
            function compress_image($source_url, $destination_url, $quality)
            {
                $info = getimagesize($source_url);
                if ($info['mime'] == 'image/jpeg')
                    $image = imagecreatefromjpeg($source_url);
                elseif ($info['mime'] == 'image/gif')
                    $image = imagecreatefromgif($source_url);
                elseif ($info['mime'] == 'image/png')
                    $image = imagecreatefrompng($source_url);
                else
                    $image = imagecreatefromfile($source_url);
                imagejpeg($image, $destination_url, $quality);
                $GLOBALS['upload'] = 1;
                return $destination_url;
            }
            $url  = $thumb_dir . $file;
            $size = filesize($_FILES["picture"]["tmp_name"]) / 1024 / 1024;
            if ($size > 2 && $size < 6)
                $filename = compress_image($_FILES["picture"]["tmp_name"], $url, 7);
            elseif ($size > 6)
                $filename = compress_image($_FILES["picture"]["tmp_name"], $url, 5);
            elseif ($size > 1 && $size < 2)
                $filename = compress_image($_FILES["picture"]["tmp_name"], $url, 8);
            elseif ($size > 0.5 && $size < 1)
                $filename = compress_image($_FILES["picture"]["tmp_name"], $url, 10);
            else
                $filename = compress_image($_FILES["picture"]["tmp_name"], $url, 50);
            if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
                unlink($target_file);
                //unlink('users_thumbs/' . $old_file);
                return 1;
            } else {
                return 2;
            }
        }
        else {
          //Incompatible size error
          return 3 ;
        }
    }
}
 ?>