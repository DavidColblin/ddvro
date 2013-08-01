<?php

    include "db.php";
	include "resizer.php"; //resizes too large images.
	
		/*Save image*/
			
			$newfolder =  "photos/" . get_new_id('chatroom');
	
		if (!opendir($newfolder)){mkdir($newfolder);}
		
		$limiter = 0;
		while ($_FILES['photo']['name'][$limiter]){
		
			$new_image= $_FILES['photo']['name'][$limiter];
			$action = move_uploaded_file($_FILES['photo']['tmp_name'][$limiter], $newfolder."/".$new_image);
			resizer($newfolder."/".$new_image, "");
			++$limiter;
		}

	 
        $date = date('l jS F Y');
        $time = time() + 28800;
        $time = date("H:i" , $time);
        $message = str_replace("'", "&#39", $_POST['message']);
		$photo = $new_image;
		
		if ($message != ""){
			$insert= mysql_query("INSERT INTO chatroom (date,hour,message)
					 values ('$date','$time','$message') ");
			 mysql_close($db);
		}
		
       
	
		function get_new_id($table){
			$select = 'select max(`id`) +1 as `id` from `'.$table.'`';
			$query = mysql_query($select);
			$obj = mysql_fetch_object($query);
			return $obj->id;
		}
		
			
		header('Location: index.php');
		
?>