
<?php 
// session_start();
include './redirect.php';


if(isset($_REQUEST['bid']))
{
    include '../Include/connect2.php';
    $bid=$_REQUEST['bid'];
    $decrypted_bid=base64_decode($bid);
    echo $decrypted_bid;
    try
    {
    $delete_blood=$connection->prepare("DELETE FROM blood_group WHERE blood_id=?");
    $delete_blood->execute([$decrypted_bid]);
    if($delete_blood->rowCount() > 0)
    {
        //sweetalert
        $_SESSION['message'] = "Blood Group Deleted Successfully";
        header("location:manageBlood.php");
        
    }
    else
    {
        $_SESSION['error-message'] = "Database error: " . $error;
    }
    }

    catch (PDOException $e) 
    {
        // Handle query errors
        $error=$e->getMessage();
        $_SESSION['error-message'] = "Database error: " . $error;
    }
    }
else
{
    header("location:manageBlood.php");
}
?>