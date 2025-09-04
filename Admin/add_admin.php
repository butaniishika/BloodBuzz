<?php 
include './redirect.php';
?>

<?php 
include '../include/connect2.php';
if(isset($_REQUEST['submit']))
{
    $img=$_FILES['img']['name'];
    $tmp=$_FILES['img']['tmp_name'];
    $email=$_POST['email'];
    $pwd=$_POST['pwd'];
    $confirm_pwd=$_POST['cpwd'];
    $token=md5(rand());

    try
   {
      $check_admin=$connection->prepare("SELECT * FROM admin_login where email= ?");
      $check_admin->execute([$email]);
      $admin=$check_admin->fetch();
      if($check_admin->rowcount() > 0)
      {
         // echo"User Already Exists...!";
         $_SESSION['error-message']="Admin Already Exists...!";
      }
      else
      {
         if($pwd==$confirm_pwd)
         {
            if(!empty($_FILES['img']['name']))
            {
               $add_admin=$connection->prepare("INSERT INTO admin_login (login_id,email,pwd,verify_token,img) VALUES (?,?,?,?,?)");
               $add_admin->execute([null,$email,$pwd,$token,$img]); 
            }
            else
            {
               $add_admin=$connection->prepare("INSERT INTO admin_login (login_id,email,pwd,verify_token) VALUES (?,?,?,?)");
               $add_admin->execute([null,$email,$pwd,$token]); 
            }
            //check query
            if($add_admin->rowCount() > 0) 
            {
               $_SESSION['message']="Admin added successfully";
               exit(0);
               // header("refresh:1;url=dashboard.php");
            } 
            else
            {
               $_SESSION['error-message']="Failed to add user.";
            }
         }
         else
         {
            $_SESSION['error-message']="Please Check Your Password.";
         }
      }
   } 
   catch (PDOException $e) 
   {
      // Handle query errors
      $error=$e->getMessage();
      $_SESSION['error-message'] = "Database error: " . $error;
   }
}
?>






<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Blood Buzz-Add Admin</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../../ecom/css/style.css">
   <link rel="icon" href="../img/logo.png" type="image/x-icon" />
   <script src="../File/js/bootstrap.min.js"></script>

   <style>
      #submit
      {
         background-color:red;
         color:white;
         font-size:large;
      }
      #submit:hover
      {
         background-color:white;
         color:red;
         font-weight:bold;
         border:1px solid black;
         font-size:large;
      }
      body
      {
         overflow:hidden;
      }
      /* .error-message,.message
      {
         background-color:#cc0000;
         color: black;
         padding: 10px;
         margin-bottom: 20px;
         font-size:medium;
         font-weight:bold;
      }
      .error-message
      {
         border: 2px solid #cc0000;
      }
      .message
      {
         border: 2px solid green;
      } */
      .error-message,.message
      {
         margin-bottom: 20px;
         font-size:medium;
         font-weight:bold;
         width:500px;
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
      
   </style>
</head>
<?php include './header.php';
      echo"<br><br>";
?>
<body>
<?php
   // Display error message if it exists
   if(isset($_SESSION['error-message']))
   {
      echo '<center><div class="error-message">' . $_SESSION['error-message'] . '</div></center>';
      unset($_SESSION['error-message']);
   }

   if (isset($_SESSION['message']))
   {
      // Display the success message
      echo '<center><div class="message" style="background-color:green;padding-left:150px;">' . $_SESSION['message'] . '</div></center>';
  
      // Unset the session variable to clear the message
      unset($_SESSION['message']);
  }
?>
<section class="form-container" style="">

   <form action="" method="post" autocomplete="off" enctype="multipart/form-data" style="margin-bottom:50px;">
   <input type="hidden" id="action" value="login">
      <h3>Add Admin</h3>
      <input type="file" name="img" id="" class="box" accept="image/*">
      <input type="email" name="email" placeholder="Enter Email" maxlength="50"  class="box" required>
      <input type="password" name="pwd" placeholder="Enter Password" maxlength="20"  class="box" required>
      <input type="password" name="cpwd" placeholder="Enter Confirm Password" maxlength="20"  class="box" required>
      <input type="submit" value="Add" class="btn" id="submit" name="submit">
   </form>

</section>

