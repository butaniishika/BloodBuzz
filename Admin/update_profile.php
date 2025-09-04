<?php
include './redirect.php';
?>
<?php
$em=$_SESSION['email'];
include '../Include/connect2.php';

//to get email from database
if(isset($_SESSION['email']))
{
  try
    {
      //fetch email in order to fill in the email field
      $fetch_data=$connection->prepare("SELECT * FROM admin_login WHERE email= ?");
      $fetch_data->execute([$em]);
      //data from database
      $data=$fetch_data->fetch();
      
    }
  catch (PDOException $e) 
    {
        // Handle query errors
        $error=$e->getMessage();
        $_SESSION['profile-error-message'] = "Database error: " . $error;
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Blood Buzz-Update Profile</title>
<link rel="icon" href="../img/logo.png" type="image/x-icon" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">

 <script src="../File/js/bootstrap.min.js"></script>
<script src="../File/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
      integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
      crossorigin="anonymous"></script>

<link rel="stylesheet" href="./updateProfile.css">

</head>
<body>
  <!-- Toggle buttons -->
  <center><button class="toggle-btn" onclick="toggleForm('profile-form')">Update Profile</button>
  <button class="toggle-btn" onclick="toggleForm('password-form')">Change Password</button></center>
<br><br><br><br>

  <?php
   // Display error message if it exists
   if(isset($_SESSION['profile-error-message']))
   {
      echo '<center><div class="error-message">' . $_SESSION['profile-error-message'] . '</div></center>';
      unset($_SESSION['profile-error-message']);
   }
   if(isset($_SESSION['profile-message']))
   {
      echo '<center><div class="message">' . $_SESSION['profile-message'] . '</div></center>';
      unset($_SESSION['profile-message']);
   }
?>

  <!-- ======================Profile update form design============================= -->
  <div id="profile-form" class="form-container" style="display:none;margin-left:350px;">
          <div class="container">
          <div class="main-body">
          <div class="row">
          <div class="col-lg-4">
          <div class="card">
          <div class="card-body">
          <div class="d-flex flex-column align-items-center text-center">
          <?php
              if($data['img']==null)
              {
                echo"<img src='../img/user.png' class='rounded-circle' width='150' height='150' alt='Profile Picture'>";
              }
              else
              {
                  echo"<img src='../img/{$data['img']}' alt='error' class='rounded-circle' height='150' width='150'>";
              }
            ?>

          <div class="mt-3">
          <div class="small text-muted mb-4">JPG or PNG no larger than 5 MB</div>
          <form autocomplete="off" action="./pfpChangeCode.php" method="POST" enctype="multipart/form-data">
          
          <div class="input-group mb-3">
          <input type="file" name="img" accept="image/*" class="form-control p-1" id="inputGroupFile02">
          </div>
          <button type="submit" name="upload" class="btn btn-outline-success">Upload</button>
          <button type="submit" name="remove" class="btn btn-outline-danger">Remove</button>
          </form>
          </div>

          </div>
          <hr class="my-4">
          </div>
          </div>
          </div>
          <div class="col-lg-6">
          <div class="card mt-5">
          <div class="card-body">

          <div class="row mb-3">
          <div class="col-sm-3">
          <h6 class="mb-0">Email</h6>
          </div>
          <div class="col-sm-9 text-secondary">
          <form action="./emailChangeCode.php" method="POST" autocomplete="off">
          <input type="email" required name="email" class="form-control" value="<?php echo $data['email']; ?>">
          </div>
          </div>


          <div class="row">
          <div class="col-sm-9 text-secondary">
          <input type="submit" name="update" class="btn btn-outline-success px-4" value="Change Email">
          </form>
          </div>
          </div>
          </div>
          </div> 
          </div>
          </div>
          </div>
          </div>
  </div>
  <!--=================== End Of Profile update form design===================== -->


  <!-- ===================Password change form================================== -->
   <div id="password-form" class="form-container" style="display:none;margin-left:350px;">
    <form action="./changePwd.php" method="POST" autocomplete="off">
              
    <div class="container">
    <div class="col-xl-8">

    <div class="card mb-4">
    <div class="card-header">Change Password</div>
    <div class="card-body">
    <div class="row gx-3 mb-3">

    <div class="col-md-6">
    <label class="small mb-1" for="inputFirstName">Old Password*</label>
    <input class="form-control" id="inputFirstName" name="old" type="password" required placeholder="Enter your Old Password" >
    </div>

    <div class="col-md-6">
    <label class="small mb-1" for="inputLastName">New Password*</label>
    <input class="form-control" id="inputLastName" name="new" type="password" required placeholder="Enter your New Password" >
    </div>
    </div>

    <div class="row gx-3 mb-3">

    <div class="col-md-6">
    <label class="small mb-1" for="inputLastName">Confirm Password*</label>
    <input class="form-control" id="inputLastName" name="cfm" type="password" required placeholder="Enter Confirm Password">
    </div>
    </div>
    <button class="btn btn-outline-danger" name="change" type="submit">Save changes</button>

   </div>
    </div>
    </div>
    </div>
    </div>
    </div> 

    </form> 
  </div>
  <!-- ===================End Of Password change form================================== -->


  <script>
    // Function to toggle form visibility
    function toggleForm(formId) {
      const form = document.getElementById(formId);
      const allForms = document.querySelectorAll('.form-container');
      
      // Hide all forms except the selected one
      allForms.forEach(form => {
        form.style.display = 'none';
      });
      form.style.display = 'block';
    }
  </script>
</body>
</html>
