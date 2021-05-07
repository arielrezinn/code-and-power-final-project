<?php

// Grab the user id from the POST data sent to us from the previous page
$userID = $_POST["userID"];

// Store the answer to the previous question, if applicable
include "../reused-components/store-answer.php";

// Grab info from the constants file
include "../reused-components/constants.php";

// Make sure the user gets the correct question for the link they're on
if ($_GET["q"] == NULL) { 
    $questionNumber = 0;
} else {
    $questionNumber = $_GET["q"];
}

// Determine action of form
if ($questionNumber == sizeof($QUESTIONS) - 1) {
    $questionAction = "../results/index.php";
} else if ($questionNumber < sizeof($QUESTIONS) - 1) {
    $questionAction = "?q=" . ($questionNumber + 1);
} else {
    header('Location: q-404.php');
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo $TITLE_QUESTION_FIRST_HALF . ($questionNumber + 1) . $TITLE_QUESTION_SECOND_HALF; ?></title>
        <link rel="stylesheet" type="text/css" href="questionstyle.css">
    </head>
    <body class="pg-questions">
        <?php include "../reused-components/navbar.php"; ?>
        <h1>Question <?php echo $questionNumber+1; ?></h1>
        <div class="container">
            <form method="post" action="<?php echo $questionAction; ?>">
                <?php echo '<h2>'.$QUESTIONS[$questionNumber].'</h2>'; ?>
                <?php echo '<p><input type="hidden" name="userID" value="'.$userID.'" /></p>'; ?>
                <?php echo '<p><input type="hidden" name="questionNumber" value="'.$questionNumber.'" /></p>'; ?>
                <?php echo '<p><input type="hidden" name="question" value="'.$QUESTIONS[$questionNumber].'" /></p>'; ?>
                <p><label><input type="radio" name="answer" value="5" required/> <?php echo $Q_OPT_5; ?></label></p>
                <p><label><input type="radio" name="answer" value="4"/> <?php echo $Q_OPT_4; ?></label></p>
                <p><label><input type="radio" name="answer" value="3"/> <?php echo $Q_OPT_3; ?></label></p>
                <p><label><input type="radio" name="answer" value="2"/> <?php echo $Q_OPT_2; ?></label></p>
                <p><label><input type="radio" name="answer" value="1"/> <?php echo $Q_OPT_1; ?></label></p>
                <p><input type="submit" value="<?php echo $Q_BUTTON_CONTINUE; ?>" class="q-button" /></p>
                <p class="q-definitions"><a href="../a11y-resources" target="_blank"><?php echo $QUESTION_DEFINITIONS; ?></a></p>
            </form>
        </div>
        <?php include "../reused-components/footer.php"; ?>
    </body>
</html>