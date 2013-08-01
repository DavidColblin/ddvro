<!DOCTYPE HTML>
<html>
<head>
	<link rel="stylesheet" href="main.css" type="text/css" />
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/prototype.js"></script>
	<script type="text/javascript" src="js/scriptaculous.js?load=effects,builder"></script>
	<script type="text/javascript" src="js/lightbox.js"></script>
	<link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" /
        <script src="galleria/galleria.js"></script>
        <style>
            
			.thumbnails {
				padding: 3px;
				-webkit-box-shadow: 0px 0px 3px grey;
				-moz-box-shadow: 0px 0px 3px grey;
				-o-box-shadow: 0px 0px 3px grey;
				box-shadow: 0px 0px 3px grey;
				padding: 7px;
				padding-bottom: 25px;				
				margin: 18px;
				margin-top: 0px;
			}
			
			.thumbnailsBox{
				margin: 20px;
			}
		
        </style>
</head>
<body>
<h1>5 derniers de DadouVero</h1>

	<a href='alllast.php'>lire tout! (tres couteux!)</a><br/>
	<a href='index.php'> retour au chatroom </a>  <br/><br/>

<?php

   include "db.php";

    $posts= mysql_query("SELECT * FROM chatroom  ORDER BY id DESC LIMIT 5");

    while( $post = mysql_fetch_array($posts)){
	$foldernumber= $post['id'];
		echo "<div class='post'>";
		echo  "<div class='date'>".$post['date'] ."</div><div class='hour'>".$post['hour']."</div>". "<p>".$post['message'] ."</p>";
	
		readFolderImages($post['id']);
		
	
	echo "<center><img src='sep.jpg'/></center></div>";
    }

	
	
function readFolderImages($folderName){

$folderPath = "photos/".$folderName;
 $folderPath = (is_dir($folderPath))?$folderPath: "photos/".($folderName-1);
 
  if (is_dir($folderPath)) 
   {
    echo '<h3>Journey\'s Album</h3><div class="thumbnailsBox">';
     $objects = scandir($folderPath);
     foreach ($objects as $object) {
       if ($object != "." && $object != ".." && $object != "Thumbs.db") {
			echo '<a href="'. $folderPath ."/". $object .'" rel="lightbox['. $folderName .']">';
          echo "<img class='thumbnails' height='140px' src='". $folderPath ."/". $object ."'>";
			echo '</a>';
       }
     }
     reset($objects);
	 echo '</div></div></div>';
	}
   
   else
	echo "";
 }

?>
<br/>
PS: tu me laule la vie :)
<br/><br/>

	<a href='alllast.php'>lire tout! (tres couteux!)</a><br/>
	<a href='index.php'> retour au chatroom </a>  <br/><br/>
		

</body>
</html>