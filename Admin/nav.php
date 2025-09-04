<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../File/css/bootstrap.min.css">
    <script src="../File/Js/bootstrap.min.js"></script>
    <script src="../File/jquery.js"></script>
    <script>
   $('.toast').toast(option)
   </script>
</head>
<body>
   <!-- Flexbox container for aligning the toasts -->
   <div
    aria-live="polite"
    aria-atomic="true"
    class="d-flex justify-content-center align-items-start"
    style="min-height: 200px">
    <!-- Then put toasts within -->
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <img src="" class="rounded me-2" alt="{4:Bootstrap}" />
            <strong class="me-auto">{4:Bootstrap}</strong>
            <small>{5:11 mins ago}</small>
            <button
                type="button"
                class="ms-2 mb-1 close"
                data-dismiss="toast"
                aria-label="Close"
>
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            Hello, world! This is a toast message.
        </div>
    </div>
   </div>
   
    
</body>
</html>

