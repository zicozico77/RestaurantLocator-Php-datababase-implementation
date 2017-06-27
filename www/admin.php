<?php

/*
 * Makes a database connection
 */
include ('connectDBclaire.php');



/**
 * Checks if the user_name and the password are in the database
 */
function check_login($user_name = null, $password = null)
{
    
    // Set up database
    $db = connect();
    // Password auth next
    if (isset($user_name) && isset($password)) {
        $query = "SELECT user_name, password FROM Owner WHERE user_name='$user_name'";
        if($result = mysqli_query($db,$query)){
            $row_cnt=mysqli_num_rows($result);
            // If we actually got a user back, row>0
            if ($row_cnt>0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $dbuser_name = $row['user_name'];
                    $dbpassword = $row['password'];
                    //verify that the password given corresponds to the hashed password stored in the database
                    if (password_verify($password, $dbpassword)){
                        //password correct
                        return True;
                
                    }
                }
            }
        }

    }
}
        


function logout_user(){
    try {
        session_unset();
    } catch (Exception $e) {
        return false;
    }
    return true;
}

?>