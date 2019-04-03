<?php
include 'fetch_songs.php';
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
</head>
<body>

<h2>musiXmongo</h2>
<div class="bg-img">
  <form action="/search.php" class="container">
<?php
for($i = 0 ; $i < count($all_songs); $i = $i + 1 ){

 echo ' <h1>'.$all_songs[$i]['name'].'</h1>
 <h3>Singer: '.$all_songs[$i]['singer'].'</h1>
 <h3>Album: '.$all_songs[$i]['album'].'</h1>
 <audio controls>
<source src="music_target/'.$all_songs[$i]['song'].'" type="audio/mpeg">
Your browser does not support the audio element.
</audio>  '  ;
 }

?>
  </form>
</div>
</body>
</html>
