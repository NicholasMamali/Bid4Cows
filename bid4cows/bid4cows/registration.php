<?php


function RegistrationDiv()

{
	echo"
	<div class='row'>
            <div class='col-md-4 col-md-offset-4' >
                <div class='login-panel panel panel-default'>
                    <div class='modal-header'>
                        <h3 class='panel-title'>Please Sign In</h3>
                    </div>
                    <div class='panel-body'>
                        <form role='form' action='loginsession.php' method='post'>

                            <fieldset>





                                <div class='form-group'>
                                    <input class='form-control' placeholder='USER ID' name='userID' type='text' autofocus required>
                                </div>



                                <div class='form-group'>
                                    <input class='form-control' placeholder='Full Name' name='fullname' type='text' autofocus required>
                                </div>

                                <div class='form-group'>
                                    <input class='form-control' placeholder='Address' name='address' type='text' autofocus required>
                                </div>

                                <div class='form-group'>
                                    <input class='form-control' placeholder='Full Name' name='fullname' type='text' autofocus required>
                                </div>


                                <div class='form-group'>
                                    <input class='form-control' placeholder='City' name='city' type='text' autofocus required>

                                    <input class='form-control' placeholder='Country' name='country' type='text' autofocus required>

                                    <input class='form-control' placeholder='postCode' name='postcode' type='text' autofocus required>

                                </div>





                                <div class='form-group'>
                                    <input class='form-control' placeholder='E-mail' name='email' type='email' autofocus required>
                                </div>
                                <div class='form-group'>
                                    <input class='form-control' placeholder='Password' name='password' type='password' value='' required>
                                </div>
                                <div class='checkbox'>
                                    <label>
                                        <input name='remember' type='checkbox' value='Remember Me'>Remember Me
                                    </label>
                                </div>
                                <button type='submit' class='btn btn-lg btn-success btn-block'>Login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
		";
	
}

?>