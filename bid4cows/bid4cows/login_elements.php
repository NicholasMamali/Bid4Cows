<?php


function loginDiv()

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
                                    <input class='form-control' placeholder='E-mail' name='email' type='email' autofocus required>
                                </div>
                                <div class='form-group'>
                                    <input class='form-control' placeholder='Password' name='password' type='password' value='' required>
                                </div>
 
                                <button type='submit' class='btn btn-lg btn-success btn-block'>Login</button>



                                <br>
                                    <label>
                                        <a href='registerpage.php'>Register</a>
                                    </label>
                                

                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
		";
	
}

?>