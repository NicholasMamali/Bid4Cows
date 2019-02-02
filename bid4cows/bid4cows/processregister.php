<?php

  include('conn.php');
  session_start();


if($_SERVER['REQUEST_METHOD']=='POST')
{
  //two passwords are matching 
    if($_POST['password']==$_POST['confirmpassword'])
    {

      //print_r($_FILES);die;
      print_r($_POST);

     

      $name= $_POST['fullname'];
      $username=$_POST['email'];
      $password=$_POST['password'];


      $avatar_path='images/'.$_FILES['avatar']['name'];


      if(preg_match("!image!", $_FILES['avatar']['type']))
      {

          //copy the image to images folder

            if(copy($_FILES['avatar']['tmp_name'],$avatar_path))
            {
                $_SESSION['fullname']=$name;
                $_SESSION['avatar']=$avatar_path;
                $_SESSION['username']=$username;

                $_SESSION['message']="Registration Succeful";


                mysqli_query($conn,"insert into users (name,email,password,avatar) values('$name','$username','$password','$avatar_path')");

                header("location:welcome.php");




  

            }



              else{
                                    $_SESSION['message']="file upload fail";

              }

      }


        else
        {
                              $_SESSION['message']="please only apload GPG,JPG,PNG files";

        }

    }



    else
    {
       $_SESSION['message']="Two passwords do not match";

    }
	
	echo  $_SESSION['message'];


}

?>
