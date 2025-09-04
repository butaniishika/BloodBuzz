<?php 
include './redirect.php';
try
{
    include '../Include/connect2.php';
    if(isset($_POST['update1']))
    {
            $email=$_SESSION['email'];
            $input_email=$_POST['email'];
            //if image set
            if((isset($_FILES['img']['name'])) && (!empty($_FILES['img']['name'])))
            {
                $img=$_FILES['img']['name'];
                $tmp=$_FILES['img']['tmp_name'];
                $change_pic=$connection->prepare("UPDATE admin_login SET img=?,email=? WHERE email=?");
                $change_pic->execute([$img,$input_email,$email]);
                if($change_pic->rowCount()>0)
                {
                    if(move_uploaded_file($tmp, "../img/".$img))
                    {
                    $_SESSION['email']=$input_email;
                    $_SESSION['profile-message']="Profile Updated Successfully";
                    }
                }
            }
            //otw only email update
            elseif((isset($_POST['email'])))
            {
                // $change_email=$connection->prepare("UPDATE admin_login SET email=? WHERE email=?");
                // $change_email->execute([$input_email,$email]);
                // if($change_email->rowCount()>0)
                // {
                //     if($_SESSION['email']=$input_email)
                //     {
                //         $_SESSION['profile-message']="Email Updated Successfully";
                //     }
                //     else{
                //         echo "session not updated";
                //     }
                // }
                // else
                // {
                //     $_SESSION['profile-error-message']="Email Not Updated".$error;
                // }
            }
    }

    elseif(isset($_POST['remove']))
    {
        $email=$_SESSION['member_email'];
        
        $remove_pic=$connection->prepare("UPDATE admin_login SET img=NULL WHERE email=?");
        $remove_pic->execute([$email]);
        if($remove_pic->rowCount() > 0)
        {
            header("location:update_profile.php");
        }
        else
        {
            $_SESSION['profile-error-message']="Database error".$error; 
        }
    }
}
catch (PDOException $e) 
{
    // Handle query errors
    $error=$e->getMessage();
    $_SESSION['profile-error-message'] = "Database error: " . $error;
}
// header("location:update_profile.php");

?>