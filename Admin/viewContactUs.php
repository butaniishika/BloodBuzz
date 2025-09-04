<?php 
include './redirect.php';
include '../Include/connect2.php';

try {
    $feedbacks = array();
    $get_feedback = $connection->prepare("SELECT feedback.*,member.* FROM feedback INNER JOIN member ON feedback.member_id=members.member_id");
    $get_feedback->execute();
    
    if ($get_feedback->rowCount() > 0) {
        while ($row = $get_feedback->fetch(PDO::FETCH_ASSOC)) {
            $feedbacks[] = $row;
        }
    } else {
        $_SESSION['error-message'] = "Failed to fetch data";
    }
} catch (PDOException $e) {
    $_SESSION['error-message'] = "Database error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Buzz-View Contact Us</title>
    <link rel="icon" href="../img/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <style>
        .error-message, .message {
            margin-bottom: 20px;
            font-size: medium;
            font-weight: bold;
            width: 500px;
            height: 40px;
            padding: 8px;
            padding-bottom: 5px;
            padding-left: 25px;
            display: inline-block;
            color: white;
        }
        .message {
            background-color: green;
            border: 2px solid green;
        }
        .error-message {
            background-color: #cc0000;
            border: 2px solid #cc0000; 
        }
    </style>
</head>
<body>
<?php include './header.php'; ?>
<div class="swiper-container">
    <div class="swiper-wrapper">
        <?php foreach ($feedbacks as $feedback): ?>
            <div class="swiper-slide">
                <img src="<?php echo $feedback['img']; ?>" alt="User Image">
                <h3><?php //echo $feedback['name']; ?></h3>
                <p>Email: <?php //echo $feedback['email']; ?></p>
                <p><?php echo $feedback['feedback']; ?></p>
            </div>
        <?php endforeach; ?>
    </div>
    <!-- Add Pagination -->
    <div class="swiper-pagination"></div>
</div>

<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
    // Initialize Swiper
    var swiper = new Swiper('.swiper-container', {
        // Optional parameters
        slidesPerView: 1, // Number of feedback items per view
        spaceBetween: 30, // Space between feedback items
        pagination: {
            el: '.swiper-pagination', // Pagination container
            clickable: true // Allow pagination bullets to be clickable
        },
    });
</script>

</body>
</html>
