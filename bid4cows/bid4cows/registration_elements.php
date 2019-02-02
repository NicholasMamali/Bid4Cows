<?php


function RegistrationDiv()

{
	echo"
	<div class='row'>
            <div class='col-md-4 col-md-offset-4' >
                <div class='login-panel panel panel-default'>
                    <div class='modal-header'>
                        <h3 class='panel-title'>Please Register</h3>
                    </div>
                    <div class='panel-body'>
                        <form role='form' action='processregister.php' method='post' enctype='multipart/form-data'>

                            <fieldset>





                                <div class='form-group'>
                                    <input class='form-control' placeholder='Full Name' name='fullname' type='text' autofocus required>
                                </div>



                                <div class='form-group'>
                                    <input class='form-control' placeholder='E-mail' name='email' type='email' autofocus required>
                                </div>
                                <div class='form-group'>
                                    <input class='form-control' placeholder='Password' name='password' type='password' value='' required>
                                </div>


                                <div class='form-group'>
                                    <input class='form-control' placeholder='Confirm Password' name='confirmpassword' type='password' value='' required>
                                </div>


                                <input type='hidden' name='register' >
                                <div class='form-group'>
                                        
                                     <input name='avatar' type='file' id='avatar' >

                                </div>
                                <button type='submit' class='btn btn-lg btn-success btn-block'>Register</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
		";
	
}

?>