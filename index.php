<!DOCTYPE html>
<html>
<head>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
	<link rel="stylesheet" href="main.css" type="text/css" />
        <script src="galleria/galleria.js"></script>
        <style>
            .content{color:#eee;font:14px/1.4 "helvetica neue", arial,sans-serif;width:620px;margin:20px auto}
            #galleria{height:400px;}
			#uploadMore{
				color: blue;
				cursor: pointer;
			}
        </style>
		<script type="text/javascript">
			$(document).ready(function() {
				var num = 1;
				$('#uploadMore').click(function(){
					 if (++num < 10){
					$('#uploads').append("<br/>Photo"+ num+" : <input type='file' name='photo[]'/>");
					}
					else 
					 alert('envoie ces photos sans message, ils iront dans le meme album juska que tu postes un nouveau message. tm <3');
				});
			});
		</script>
</head>
<body>

<?php

   include "db.php";
    $count= mysql_num_rows(mysql_query("SELECT * FROM chatroom"));
    $posts= mysql_query("SELECT * FROM chatroom  ORDER BY id DESC LIMIT 1");

    echo "<h1>DadouVero <3 (". $count ."eme léttre..)</h1>
		<a href='fivelast.php'>lire 5 derniers! (couteux!)</a><br/>
		<a href='allast.php'> Tout relire! </a> <br/><br/>";

	
	
    while( $post = mysql_fetch_array($posts)){
	
	$foldernumber= $post['id'];
	echo "<div class='post'>";
    echo  "<div class='date'>".$post['date'] .
		"</div><div class='hour'>".$post['hour'].
		"</div><p>" .$post['message'] ."</p>";
	
	
	readFolderImages($foldernumber+1);
	
	echo "<center><img src='sep.jpg'/></center></div>";
    }

function readFolderImages($folderName){

$folderPath = "photos/".$folderName;
 $folderPath = (is_dir($folderPath))?$folderPath: "photos/".($folderName-1);
 
  if (is_dir($folderPath)) 
   {
    echo ' <div class="content"><h1>Journey\'s Album</h1><div id="galleria">';
     $objects = scandir($folderPath);
     foreach ($objects as $object) {
       if ($object != "." && $object != ".." && $object != "Thumbs.db") {
          echo "<img src='". $folderPath ."/". $object ."'>";
       }
     }
     reset($objects);
	 echo '</div></div>';
	}
   
   else
	echo "";
 }

?>
<br/><br/>

	<script>
		// Load the classic theme
		Galleria.loadTheme('galleria/themeclassic/galleria.classic.js');
		// Initialize Galleria
		$('#galleria').galleria();
		

    </script>

<center>
<div id="formpost">
	<form action='post.php' method='post' enctype='multipart/form-data'>
	 
		<textarea type='text' name='message' cols='105' rows='5'></textarea><br/>
		<div id='uploads'>
			<br/>Photo1: <input type='file' name='photo[]'/>
		</div>
			<b id='uploadMore'> Upload More! </b><br/><br/>
		<input type='submit' value='Poster la lettre!' width="100"/>
	</form>
</div>
</center>
	Dadou Selov Euqinorev! x) <br/>
</body>
</html>