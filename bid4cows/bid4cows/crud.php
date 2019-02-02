
<?php

	include('conn.php');
	$ownerID=$_POST['ownerID'];
	$crud=$_POST['crud'];
	$id=$_POST['id'];



	//$image = $_FILES['image']['name'];

	
	if(isset($_FILES['file']))
	{ 
    	$avatar_path=mysql_real_escape_string('images/'.$_FILES['avatar']['name']);
    }


	function copyImage()
	{
				 $avatar_path='images/'.$_FILES['avatar']['name'];


			if(preg_match("!image!", $_FILES['avatar']['type']))
	      	{

	          //copy the image to images folder
	            if(copy($_FILES['avatar']['tmp_name'],$avatar_path))
	            {
	            }
	        }
	}








if($crud=='update')
{
		//print_r($_POST);
		//adding path of the image
		 $avatar_path='images/'.$_FILES['avatar']['name'];
		if(preg_match("!image!", $_FILES['avatar']['type']))
      	{

          //copy the image to images folder
            if(copy($_FILES['avatar']['tmp_name'],$avatar_path))
            {
            }
        }
		$name=$_POST['name'];
		$age=$_POST['age'];
		$address=$_POST['address'];
		$description=$_POST['description'];

		$foodType=$_POST['foodType'];
		$uncestors=$_POST['uncestors'];
		$type=$_POST['type'];
		$previousOwner=$_POST['previousOwner'];

		//foodType='$foodType',uncestors ='$uncestors',time='$time',previousOwner='$previousOwner'
		mysqli_query($conn,"update cattle set name='$name', age='$age', description='$description', ownerID='$ownerID', address='$address',foodType='$foodType',uncestors ='$uncestors',type='$type',previousOwner='$previousOwner',image='$avatar_path'

		 where id='$id'");
	}


	if ($crud=='create')
	{


				//adding path of the image
		 $avatar_path="images/".$_POST['ownerID']."".$_POST['name']."".$_FILES['avatar']['name'];
		 $avatar_path2="images/".$_POST['ownerID']."".$_POST['name']."".$_FILES['avatar2']['name'];
		 //<input type='file' name='avatar2' accept='image/*' class='form-control' value='image2'>

		 if(preg_match("!image!", $_FILES['avatar2']['type']))
      	{

          //copy the image to images folder
            if(copy($_FILES['avatar2']['tmp_name'],$avatar_path2))
            {
            }
        }


		if(preg_match("!image!", $_FILES['avatar']['type']))
      	{

          //copy the image to images folder
            if(copy($_FILES['avatar']['tmp_name'],$avatar_path))
            {
            }
        }


		$name=$_POST['name'];
		$age=$_POST['age'];
		$address=$_POST['address'];
		$description=$_POST['description'];
		$foodType=$_POST['foodType'];
		$uncestors=$_POST['uncestors'];
		$time=$_POST['type'];
		$ownerID = $_POST['ownerID'];
		$previousOwner=$_POST['previousOwner'];





		//mysqli_query($conn,"insert into cattle (name, age, address,description,foodType,uncestors,time,previousOwner,ownerID,image) 
		//values ('$name', '$age', '$address','$description','$foodType','$uncestors','$time','$previousOwner',$ownerID),'$avatar_path'");



		print_r($avatar_path2);
		print_r($avatar_path);


		mysqli_query($conn,"insert into cattle (name,ownerID,image,age,address,description,foodType,uncestors,type,previousOwner,image1) values('$name','$ownerID','$avatar_path','$age','$address','$description','$foodType','$uncestors','$time','$previousOwner','$avatar_path2')");
		
		$result  = mysqli_query($conn, "select * from users where id =".$ownerID." ");
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$bids= 1 + $row['cattleNo'];
		$result  = mysqli_query($conn,"update users set cattleNo=".$bids." where id=".$ownerID."");
	
	}



	if ($crud=='delete')
	{
		mysqli_query($conn,"delete from cattle where id='$id'");

	}


	if($crud=='auction')
	{
		print_r($_POST);
		$price=$_POST['price'];
		$minimumBid=$_POST['minimumBid'];
		$endDate=$_POST['endDate'];
		$description=$_POST['description'];
		$ownerID=$_POST['ownerID'];
		$cowID=$_POST['id'];
		$location = $_POST['location'];
		$type = $_POST['type'];
		$image=$_POST['image1'];
		$image1=$_POST['image2'];


		mysqli_query($conn,"insert into auction (price,cowID,ownerID,endDate,minimum,location,type) values ('$price','$cowID','$ownerID','$endDate','$minimumBid','$location','$type')");
		
		$result  = mysqli_query($conn, "select * from users where id =".$ownerID." ");
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$bids= 1 + $row['auctionNo'];
		$result  = mysqli_query($conn,"update users set auctionNo=".$bids." where id=".$ownerID."");
		

		if(isset($_POST['foodType'],$_POST['uncestors'],$_POST['previousOwner']))
		{   
			$foodType=$_POST['foodType'];
			$uncestors=$_POST['uncestors'];
			$previousOwner=$_POST['previousOwner'];

			mysqli_query($conn,"insert into details (foodType,cowID,uncestors,previousOwner,image,image1) values ('$foodType','$cowID','$uncestors','$previousOwner','$image','$image1')");
		}

		else if(empty($_POST['foodType']) && isset($_POST['uncestors'],$_POST['previousOwner']))
		{

			//$foodType=$_POST['foodType'];
			$uncestors=$_POST['uncestors'];
			$previousOwner=$_POST['previousOwner'];


			mysqli_query($conn,"insert into details (foodType,cowID,uncestors,previousOwner) values ('NULL','$cowID','$uncestors','$previousOwner')");
		}



		else if(empty($_POST['uncestors']) && isset($_POST['foodType'],$_POST['previousOwner']))
		{

			$foodType=$_POST['foodType'];
			//$uncestors=$_POST['uncestors'];
			$previousOwner=$_POST['previousOwner'];
			mysqli_query($conn,"insert into details (foodType,cowID,uncestors,previousOwner) values ('$foodType','$cowID','NULL','$previousOwner')");
		}

		else if(empty($_POST['previousOwner']) && isset($_POST['foodType'],$_POST['uncestors']))
		{	
			$foodType=$_POST['foodType'];
			$uncestors=$_POST['uncestors'];
			//$previousOwner=$_POST['previousOwner'];


			mysqli_query($conn,"insert into details (foodType,cowID,uncestors,previousOwner) values ('$foodType','$cowID','uncestors','NULL')");
		}







		else if(isset($_POST['foodType']) && empty($_POST['uncestors'])&& empty($_POST['previousOwner']))
		{

			$foodType=$_POST['foodType'];
			//$uncestors=$_POST['uncestors'];
			//$previousOwner=$_POST['previousOwner'];


			mysqli_query($conn,"insert into details (foodType,cowID,uncestors,previousOwner) values ('$foodType','$cowID','NULL','NULL')");
		}



		else if(isset($_POST['uncestors']) && empty($_POST['foodType']) && empty($_POST['previousOwner']))
		{

			//$foodType=$_POST['foodType'];
			$uncestors=$_POST['uncestors'];
			//$previousOwner=$_POST['previousOwner'];
			mysqli_query($conn,"insert into details (foodType,cowID,uncestors,previousOwner) values ('NULL','$cowID','$uncestors','NULL')");
		}

		else if(isset($_POST['previousOwner']) && empty($_POST['foodType']) && empty($_POST['uncestors']))
		{	
			//$foodType=$_POST['foodType'];
			//$uncestors=$_POST['uncestors'];
			$previousOwner=$_POST['previousOwner'];
			mysqli_query($conn,"insert into details (foodType,cowID,uncestors,previousOwner) values ('NULL','$cowID','NULL','$previousOwner')");
		}

		else if(empty($_POST['uncestors']) && empty($_POST['previousOwner']) && empty($_POST['foodType']))
		{

			//mysqli_query($conn,"insert into details (foodType,cowID,uncestors,previousOwner) values ('$foodType','$cowID','NULL','$previousOwner')");
		}
	 

	}


	//removing auction


	if($crud=='deleteAuction')
	{	
				//print_r($_POST);

		mysqli_query($conn,"delete from auction where cowID='$id'");

	}


	header('location:cattle.php');

?>