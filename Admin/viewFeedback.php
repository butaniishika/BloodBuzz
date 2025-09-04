<?php 
include './redirect.php';
include './header.php';
include '../Include/connect2.php';
?>


<?php
try
{
    $feedbacks = array();
    $get_feedback=$connection->prepare("SELECT * FROM feedback JOIN members ON feedback.member_id=members.member_id");
    $get_feedback->execute();
    if($get_feedback->rowCount() > 0)
    {
        while ($row = $get_feedback->fetch(PDO::FETCH_ASSOC))
        {
            $feedbacks[] = $row;
        }
    }
}
catch (PDOException $e) 
{
      // Handle query errors
      $error=$e->getMessage();
      $_SESSION['error-message'] = "Database error: " . $error;
}








// Fetch feedback data from the database including user details
// Your database connection and query to fetch feedback data here
// Assume $feedbacks is an array containing feedback data with user details

// Example data for demonstration
// $feedbacks = [
//     ['feedback_id' => 1, 'member_id' => 1, 'feedback' => 'Feedback content 1', 'date' => '2024-02-17'],
//     ['feedback_id' => 2, 'member_id' => 2, 'feedback' => 'Feedback content 2', 'date' => '2024-02-16'],
//     ['feedback_id' => 3, 'member_id' => 3, 'feedback' => 'Feedback content 3', 'date' => '2024-02-15'],
//     ['feedback_id' => 3, 'member_id' => 3, 'feedback' => 'Feedback content 3', 'date' => '2024-02-15'],

//     // Add more feedback data as needed
// ];

// Example user data for demonstration
// $users = [
//     ['member_id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com', 'image' => 'user1.jpg'],
//     ['member_id' => 2, 'name' => 'Jane Smith', 'email' => 'jane@example.com', 'image' => 'user2.jpg'],
//     ['member_id' => 3, 'name' => 'Alice Johnson', 'email' => 'alice@example.com', 'image' => 'user3.jpg'],
//     ['member_id' => 3, 'name' => 'Alice Johnson', 'email' => 'alice@example.com', 'image' => 'user3.jpg'],

//     // Add more user data as needed
// ];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Feedback</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <!-- Add your CSS styles here -->
</head>
<body>
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <?php foreach ($feedbacks as $feedback): ?>
                <div class="swiper-slide">
                    <!-- <img src="<?php //echo $users[$feedback['member_id']]['image']; ?>" alt="User Image"> -->
                    <img src="<?php echo $feedback['img']; ?>" alt="User Image">
                    <h3><?php //echo $users[$feedback['member_id']]['name']; ?></h3>
                    <p>Email: <a href="mailto:<?php //echo $users[$feedback['member_id']]['email']; ?>">
                    <?php //echo $users[$feedback['member_id']]['email']; ?></a></p>
                    <p><?php echo $feedback['feedback']; ?></p>
                    <p>Date: <?php echo $feedback['created_at']; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
    </div>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper('.swiper-container', {
            // Optional parameters
            slidesPerView: 3,
            spaceBetween: 30,
            pagination: {
                el: '.swiper-pagination',
                clickable: true
            }
        });
    </script>
</body>
</html>
