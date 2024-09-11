<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Current Date and Time</title>
</head>
<body>

    <h1>Current Date and Time</h1>
    
    <?php
    date_default_timezone_set('America/Costa_Rica');
    
    $currentDateTime = date('Y-m-d H:i a');
    
    echo "<p>Current Date and Time: $currentDateTime</p>";
    ?>

</body>
</html>
