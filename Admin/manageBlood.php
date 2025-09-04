<?php 
include './redirect.php';
include '../Include/connect2.php';

    try
    {
        $fetch_blood_data = $connection->prepare("SELECT * FROM blood_group");
        $fetch_blood_data->execute();
        $blood_data = $fetch_blood_data->fetchAll(PDO::FETCH_ASSOC);
    } 
    catch (PDOException $e) 
    {
        // Handle database error
        $error_message = "Database error: " . $e->getMessage();
    }
?>  





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Buzz-Manage Blood</title>
    <link rel="icon" href="../img/logo.png" type="image/x-icon" />
    <script src="../File/js/bootstrap.min.js"></script>
    <script src="../File/jquery.js"></script>
    <link rel="stylesheet" href="../../ecom/css/admin_style.css">

    <style>
        table
        {
            align-items:center;
            margin-left:350px;
        }
        table
        {
            width: 80%;
            border-collapse: collapse;
        }

        th,td
        {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            font-size:large;
        }
        th
        {
            background-color: #f2f2f2;
        }
        .error-message,.message
        {
         margin-bottom: 20px;
         font-size:medium;
         font-weight:bold;
         width:300px;
         height:40px;
         padding:8px;
         padding-bottom:5px;
         padding-left:25px;
         display: inline-block;
         color: white;
        }
        .message
        {
        background-color:green;
        border: 2px solid green;
        }
        .error-message
        {
        background-color:#cc0000;
        border: 2px solid #cc0000; 
        }
        h1
        {
        margin-top:75px;
        }
      #update,#delete,#addBloodGroupBtn,#submit,#edit
      {
        width:200px;
      }
      #bloodGroupInput
      {
        width:400px;
        height:40px;
        border:1px solid black;
        padding:7px;
        font-size:large;
      }
      #insertBtn
      {
        width:200px;
        height:50px;
      }
      #cancelBtn
      {
        background-color:red;
        color:white;
        width:100px;
        font-weight:bold;
        height:40px;
        font-size:medium;
      }
    </style>
</head>
<body>
    
    <?php include './header.php';
    
    // Display error message if it exists
   if(isset($_SESSION['error-message']))
   {
      echo '<center><div class="error-message">' . $_SESSION['error-message'] . '</div></center>';
      unset($_SESSION['error-message']);
   }
   if(isset($_SESSION['message']))
   {
      echo '<center><div class="message" style="background-color:green;class="center-text"">' . $_SESSION['message'] . '</div></center>';
      unset($_SESSION['message']);
   }
   
   ?>
   
    <center><h1>Blood Groups</h1><br>
    <!--insert blood group-->
    <input type="submit" value="Insert Blood Group" class="btn" id="insertBtn" name="add" onclick="toggleBloodGroupInputs()">

    <form id="bloodGroupInputs" style="display: none;" action="addBlood.php">
    <input type="text" id="bloodGroupInput" placeholder="Enter Blood Group" style="padding: 10px; font-size: 16px; width: 200px; height: 40px;" name="group">
    <button type="button" id="cancelBtn" onclick="cancelBloodGroup()">Cancel</button>
    <button type="submit" id="cancelBtn" style="background-color:#00609C;color:white;cursor:pointer;" name="insert">Add</button>
    </form>

    <script src="try.js"></script>
   <!-- End of Insert blood group -->
    <br><br><br></center>
    <?php if(isset($_SESSION['error-message'])): ?>
        <p>
        <?php 
        echo '<center><div class="error-message">' . $_SESSION['error-message'] . '</div></center>';
        unset($_SESSION['error-message']);
       ?>
       </p>

        
    <?php else: ?>
        <center><table>
            <thead>
                <tr>
                    <th>Blood ID</th>
                    <th>Blood Group</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($blood_data as $blood): ?>
                    <tr>
                        <td><?php echo $blood['blood_id']; ?></td>
                        <td><?php echo $blood['blood_grp']; ?></td>
                        <td>
                        <form method="post">
                            <input type="hidden" name="blood_id" value="<?php echo $blood['blood_id']; ?>">
                            <input type="submit" value="Edit" class="btn" id="update" name="update"></form>
                        <form method="post">
                            <input type="hidden" name="blood_id" value="<?php echo $blood['blood_id']; ?>">
                            <input type="submit" value="Delete" class="btn" id="delete" name="delete"></form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table></center>
    <?php endif; ?>
    
    
</body>
</html>


<?php 
if($fetch_blood_data->rowCount() > 0)
{
    if(isset($_REQUEST['update']))
    {
        $encrypted_bid=base64_encode($_POST['blood_id']);
        try
        {
        header("location:updateBlood.php?bid=$encrypted_bid");
        }
        catch (PDOException $e) 
        {
            // Handle query errors
            $error=$e->getMessage();
            $_SESSION['error-message'] = "Database error: " . $error;
        }
    }
    if(isset($_POST['delete']))
    {
        $encrypted_bid=base64_encode($_POST['blood_id']);

        try
        {
        header("location:deleteBlood.php?bid=$encrypted_bid");
        }
        catch (PDOException $e) 
        {
            // Handle query errors
            $error=$e->getMessage();
            $_SESSION['error-message'] = "Database error: " . $error;
        }
    }
}

?>
