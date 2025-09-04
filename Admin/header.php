
<link rel="stylesheet" href="../../ecom/css/admin_style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
<script src="../File/js/bootstrap.min.js"></script>
<script src="../File/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
      integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
      crossorigin="anonymous"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"
      integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk"
      crossorigin="anonymous"></script> -->
<header class="header" style="position: sticky;top: 0; z-index: 10;">

   <section class="flex">
      
      <a href="../admin/dashboard.php" class="logo">Admin<span>Panel</span></a>
      
      <nav class="navbar" id="navbarsExample07XL">
         <a href="./dashboard.php">Home</a>
         <a href="./add_admin.php">Add Admin</a>
         <a href="./manageBlood.php">Manage Blood</a>
         <a href="./viewFeedback.php">View Feedback</a>
         <a href="./viewContactUs.php">View Contact Us</a>
         <a href="./logout.php">Log Out</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php
            // $select_profile = $connection->prepare("SELECT * FROM `admin_login` WHERE login_id = ?");
            // $select_profile->execute([$login_id]);
            // $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         
         <!-- <a href="../admin/update_profile.php" class="btn">Update profile</a>
         <div class="flex-btn">
            <a href="../admin/register_admin.php" class="option-btn">Register</a>
            <a href="../admin/admin_login.php" class="option-btn">Login</a>
         </div>
         <a href="../components/admin_logout.php" class="delete-btn" onclick="return confirm('logout from the website?');">logout</a>  -->
      </div>
      <!-- toggler -->
      <div class="d-flex">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample07XL"
              aria-controls="navbarsExample07XL" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
      </button>
      </div>

   </section>

</header>
