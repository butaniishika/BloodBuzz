<?php
include './redirect.php';
include '../Include/connect2.php';

// Define how many results you want per page
$resultsPerPage = 5;

// Get the total number of contact us messages
$totalMessagesQuery = $connection->query("SELECT COUNT(*) AS total FROM contact_us");
$totalMessages = $totalMessagesQuery->fetchColumn();

// Calculate the total number of pages
$totalPages = ceil($totalMessages / $resultsPerPage);

// Get the current page number
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$startIndex = ($page - 1) * $resultsPerPage;

try {
    // Fetch contact us messages for the current page
    $stmt = $connection->prepare("
        SELECT *
        FROM contact_us
        ORDER BY created_at DESC
        LIMIT :startIndex, :resultsPerPage
    ");
    $stmt->bindParam(':startIndex', $startIndex, PDO::PARAM_INT);
    $stmt->bindParam(':resultsPerPage', $resultsPerPage, PDO::PARAM_INT);
    $stmt->execute();
    $contact_us = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Handle query errors
    $error = $e->getMessage();
    $_SESSION['error-message'] = "Database error: " . $error;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Buzz-All Contact Us</title>
    <link rel="icon" href="../img/logo.png" type="image/x-icon" />
    <script src="../File/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../File/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .accordion-item {
            width: 80%; /* Adjust the width as needed */
            margin: auto; /* Center the accordion items */
            margin-top:30px;
        }
        .pagination
        {
            margin-left:160px;
        }
    </style>
</head>
<body>
<div class="accordion accordion-flush" id="accordionFlushExample">
    <?php
        foreach($contact_us as $key => $allCU) {
    ?>
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-heading-<?php echo $key; ?>">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse-<?php echo $key; ?>" aria-expanded="false" aria-controls="flush-collapse-<?php echo $key; ?>">
                    <?php echo $key + 1 ; echo "]"." ".$allCU['reason']; ?>
                </button>
            </h2>
            <div id="flush-collapse-<?php echo $key; ?>" class="accordion-collapse collapse" aria-labelledby="flush-heading-<?php echo $key; ?>" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <p><?php echo "<b>Name: </b>".$allCU['name']; ?>&nbsp;
                    <a role="button" class="btn btn-outline-primary" href="mailto:<?php echo $allCU['email']; ?>"><i class="bi bi-envelope"></i>&nbsp;Email</a>
                    <a role="button" href="deleteContactUs.php?cid=<?php echo $allCU['contactus_id']; ?>" class="btn btn-outline-danger"><i class="bi bi-trash3-fill"></i>&nbsp;Delete</a></p>
                  <?php  //$_SESSION['cid']=$allCU['contactus_id']; ?>
                    </p>
                    <!-- Display the contact message here -->
                </div>
            </div>
        </div>
    <?php
        }
    ?>
    </div>

    <!-- Pagination -->
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-left mt-5">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?php echo ($page == $i) ? 'active' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</body>
</html>
