	
<?php

	include('conn.php');



		$userID=$_POST['userID'];


		$avatar_path='images/'.$_FILES['avatar']['name'];

		if(preg_match("!image!", $_FILES['avatar']['type']))
      	{

          //copy the image to images folder
            if(copy($_FILES['avatar']['tmp_name'],$avatar_path))
            {
            }
        }


		print_r($avatar_path);
		print_r($userID);

		
		mysqli_query($conn,"UPDATE `users` SET `avatar` = '".$avatar_path."' WHERE `users`.`id` = ".$userID."");

		echo "UPDATE `users` SET `avatar` = '".$avatar_path."' WHERE `users`.`id` = ".$userID."";
		header('location:user.php');



	
?>