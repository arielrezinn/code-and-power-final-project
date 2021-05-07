<?php

include "../reused-components/constants.php";

// Generate a random userID to use to identify the visitor throughout the survey
$userID = rand(1000000, 9999999);

// todo sql query to see if the userID already exists in DB
include "../reused-components/dbinfo.php";

do {
// Prepare query to see if newly generated userID exists in DB already
$query = $conn->prepare("SELECT * FROM `group1final-spring2021` where userID = ?");
$query->bind_param("i", $userID);

// Run query and get results from the database
$query->execute();
$results = $query->get_result();

// Generate a new random userID to use to identify the visitor throughout the survey
$userID = rand(1000000, 9999999);
} while (sizeof((array)$results->fetch_assoc()) > 0);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>
            <?php echo $TITLE_SURVEY_INSTRUCTIONS_PAGE; ?>
        </title>
        <!--<link rel="stylesheet" type="text/css" href="questionstyle.css">-->
    </head>
    <body class="pg-instructions">
        <?php include "../reused-components/navbar.php"; ?>
        <h1><?php echo $SURVEY_TITLE; ?></h1>
        <div class="container">
            <p><?php echo $SURVEY_GENERAL_INFO; ?></p>
            <p><?php echo $SURVEY_DURATION_INFO; ?></p>
            <p><?php echo $SURVEY_TIME_INFO; ?></p>
            <form method="post" action="?q=0">
                <?php echo '<input type="hidden" name="userID" value="'.$userID.'" />'; ?>
                <p><input type="submit" value="<?php echo $SURVEY_BUTTON_BEGIN; ?>" class="btn-instructions" /></p>
            </form>
        </div>
        <?php include "../reused-components/footer.php"; ?>
    </body>
</html>