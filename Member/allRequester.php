<?php 
include './redirect.php';
//include './header2.php';
include './nav.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Blood Buzz-Requester Page</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.27.0/feather.min.js" integrity="sha256-xHkYry2yRjy99N8axsS5UL/xLHghksrFOGKm9HvFZIs=" crossorigin="anonymous"></script>
<script src="../File/js/bootstrap.min.js"></script>
<script src="../File/jquery.js"></script>
  <script src="../File/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../File/css/bootstrap.min.css">
<link rel="icon" href="../img/logo.png" type="image/x-icon" />

<style type="text/css">
    .own
    {
        margin-top:40px;
    }
    .msg
    {
        color:green;
    }
    .location
    {
        color:red;
    }
    .envelop
    {
        color:#4B0082;
    }
    .msg:hover,.envelop:hover,.location:hover{
        text-decoration:none;
    }
    .m-b-30
    {
        margin-bottom: 30px;
    }
    p
    {
    color: #8A98AC;    
    }
    .table-borderless td
    {
        border: 0 !important;
    }
    .table td
    {
        color: #8A98AC;
        vertical-align: middle;
        border-top: 1px solid rgba(0, 0, 0, 0.03);
        padding: 0.6rem;
    }
    .card
    {
        border: none;
        border-radius: 3px;
        background-color: #ffffff;
    }
     .pagination
    {
    display: inline-block;
    margin-left:199px;
    }
    #email,#msg
    {
        border:1px solid black;
        background-color:#f0f0f0;
        font-size:medium;
    }
    .form-inline
    {
        margin-top:35px;
        margin-bottom:-20px;
        margin-left:189px;
    }
    </style>
</head>
<body>



<div></div>
<!--============ search blood group ============= -->

<nav class="navbar navbar-danger">
  <form  id="search_form"class="form-inline" method="post">
    <?php
        include_once '../Include/connect2.php';
        // Query to fetch blood groups from the database
        $query = "SELECT * FROM blood_group";
        $result = $connection->query($query);

        // Check if there are any rows returned
        if ($result->rowCount() > 0)
        {
            echo '<select  aria-label="Search" class="form-control mr-sm-2" name="blood_group" id="blood_group">';
            echo '<option selected disabled value="">Select Blood Group</option>'; 

            // Loop through each row and add options to the dropdown
            while ($row = $result->fetch(PDO::FETCH_ASSOC))
            {
                $blood_id=$row['blood_id'];
                $blood_group = $row['blood_grp'];
                echo "<option value='$blood_id'>$blood_group</option>";
            }
            echo '</select>';
        } 
        else
        {
            echo '<option disabled >No Blood Groups Found</option>';
        }
    ?>
    
    <button style="" class="btn btn-outline-danger my-2 my-sm-0" type="submit" name="search" id="">Search</button>
  </form>
</nav>

<?php
// include '../include/connect2.php'; 
try
{

// =====================Pagination=====================
    // Define total records per page
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $records_per_page = 4; // Number of records per page
    $offset = ($page - 1) * $records_per_page;

    // Get total number of records
    $total_records_query ="SELECT COUNT(*) AS total FROM requester";
    $total_records_result = $connection->query($total_records_query);
    $total_records = $total_records_result->fetch(PDO::FETCH_ASSOC)['total'];

    // Calculate total number of pages
    $total_pages = ceil($total_records / $records_per_page);
//======================end of pagination======================


    // Fetch data for current page
    
    if(isset($_POST['search']))
    {

        $search_group=$_POST['blood_group'];
        $query = "SELECT requester.*, members.* 
        FROM requester 
        INNER JOIN members ON requester.member_id = members.member_id 
        WHERE requester.blood_id =? LIMIT $offset, $records_per_page";

        $result = $connection->prepare($query);
        $result->execute([$search_group]);
    }
    else
    {
        $query="SELECT requester.*, members.* 
            FROM requester 
            INNER JOIN members ON requester.member_id = members.member_id LIMIT $offset, $records_per_page";
        $result = $connection->query($query);
    }


    if ($result->rowCount() > 0) 
    {
    ?> 
    <div class="own">
    <div class="container">
    <div class="row">       
    <?php
        while($row = $result->fetch(PDO::FETCH_ASSOC)) 
    {
    ?>

    
    <div class="col-lg-6">
    <div class="card m-b-30">
    <div class="card-body py-5"> 
    <div class="row">
    <div class="col-lg-3 text-center">

    <?php 
        if($row['img']==null)
        {
        echo"<img src='../img/user.png' class='img-fluid mb-3' alt='user'>";
        }
        else
        {
            echo "<img src='../img/{$row['img']}' class='img-fluid mb-3' alt='user'>";
        }
    ?>

    </div>

    <div class="col-lg-9">
    <h4><?php echo "Patient Name :&nbsp;".$row['patient_name']; ?></h4>
    
    <!-- email btn -->
    <div class="button-list mt-4 mb-3">
    <button type="button" id="email" class="btn btn-primary-rgba"><a class="envelop" href="mailto:<?php echo $row['email']; ?>"><i class="bi bi-envelope"></i>&nbsp;Email</a></button>

    <!-- whatsapp btn -->
    <?php $cno="91". $row['contact_no']; ?>
    <button type="button" id="msg" class="btn btn-success-rgba"><a href="https://api.whatsapp.com/send?phone=<?php echo $cno; ?>" class="msg"><i class="bi bi-whatsapp"></i>&nbsp;Message</a></button>

    <!-- location btn -->
    <button type="button" id="msg" class="btn btn-success-rgba"><a href="./userMap.php?mid=<?php echo $row['member_id'];?>" class="location"><i class="bi bi-geo-alt-fill"></i>&nbsp;Location</a></button>
    </div>

    <div class="table-responsive">
    <table class="table table-borderless mb-0">
    <tbody>
    <tr>
    <th scope="row" class="p-1">Address :</th>
    <td  style="height:100px;" class="p-1"><?php echo $row['address']; ?></td>
    </tr>
    <tr>
    <?php
    //fetch state
    $sid=$row['state'];
    $state=$connection->prepare("SELECT DISTINCT state_name FROM states WHERE state_id=?");
    $state->execute([$sid]);
    $sname=$state->fetchColumn();
    // echo $sname;
    ?>
    <th scope="row" class="p-1">State :</th>
    <td style="height:10px;" class="p-1"><?php echo $sname; ?></td>
    </tr>



    <tr>
    <?php
    //fetch state
    $cid=$row['city'];
    $city=$connection->prepare("SELECT DISTINCT city_name FROM city WHERE city_id=?");
    $city->execute([$cid]);
    $cname=$city->fetchColumn();
    ?>
    <th scope="row" class="p-1">City :</th>
    <td style="height:10px;" class="p-1"><?php echo $cname; ?></td>
    </tr>



    <tr>
    <?php
    //fetch state
    $bid=$row['blood_id'];
    $blood=$connection->prepare("SELECT DISTINCT blood_grp FROM blood_group WHERE blood_id=?");
    $blood->execute([$bid]);
    $blood_group=$blood->fetchColumn();
    ?>
    <th scope="row" class="p-1">Require Blood:</th>
    <td style="height:10px;" class="p-1"><?php echo $blood_group; ?></td>
    </tr>
    </tbody>
    </table>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>


    <?php
    }//while
    ?>

        </div>
        </div>
        </div>

    <?php
    } 
    else 
    {
       header("location:noRequester.php");
    }

    ?>
<!-- Pagination links -->
<nav aria-label="Feedbacks Pagination">
        <ul class="pagination">
            <li class="page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
                <a class="page-link" href="?page=<?php echo ($page <= 1) ? 1 : ($page - 1); ?>">Previous</a>
            </li>
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <li class="page-item <?php echo ($page == $i) ? 'active' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
            </li>
            <?php endfor; ?>
            <li class="page-item <?php echo ($page >= $total_pages) ? 'disabled' : ''; ?>">
                <a class="page-link" href="?page=<?php echo ($page >= $total_pages) ? $total_pages : ($page + 1); ?>">Next</a>
            </li>
        </ul>
    </nav>
<!-- End of Pagination links -->

   <?php  include './footer.php';

}
catch (PDOException $e) 
{
    // Handle query errors
    $error=$e->getMessage();
    $_SESSION['error-message'] = "Database error: " . $error;
}
?>







</div>
</div>
<!-- <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script> -->
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
</script>
</body>
</html>