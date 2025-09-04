<?php
include './redirect.php';

try
{
include '../Include/connect2.php';

if(isset($_REQUEST['cid']))
{
    $cid=$_REQUEST['cid'];
    date_default_timezone_set('Asia/Kolkata');
    $datetime=date('Y/m/d h:i:s');

    //get data
    $get_cu=$connection->prepare("SELECT email,reason FROM contact_us WHERE contactus_id=?");
    $get_cu->execute([$cid]);
    $data=$get_cu->fetch();

    //delete data
    $delete_cu=$connection->prepare("DELETE FROM contact_us WHERE contactus_id=?");
    $delete_cu->execute([$cid]);
    

    //insert into another table
    $insert_cu=$connection->prepare("INSERT INTO deleted_contact VALUES(null,?,?,?)");
    $insert_cu->execute([$data['email'],$data['reason'],$datetime]);
    

    //=========delete from delete=====================
    $oneMonthAgo = date('Y-m-d', strtotime('-1 month'));
    // echo $oneMonthAgo;
    // Prepare and execute the SQL query to select records older than one month
    $deleteMonth = $connection->prepare("SELECT delete_id FROM deleted_contact WHERE created_at < ?");
    $deleteMonth->execute([$oneMonthAgo]);

    // Fetch the results and store them in a variable
    $olderThanOneMonth = $deleteMonth->fetchAll(PDO::FETCH_ASSOC);

    // Output the results
    foreach ($olderThanOneMonth as $row) {
        // echo "Delete ID: " . $row['delete_id'] . "<br>";
    }
    if($row['delete_id'])
    {
    $deleteIt=$connection->prepare("DELETE FROM deleted_contact WHERE delete_id=?");
    $deleteIt->execute([$row['delete_id']]);
    }

}

}
catch (PDOException $e) 
{
    // Handle query errors
    $error=$e->getMessage();
    $_SESSION['error-message'] = "Database error: " . $error;
}
header("location:seeContactUs.php");
?>