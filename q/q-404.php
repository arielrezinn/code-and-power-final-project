<?php

include "../reused-components/constants.php";

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>
            <?php echo $TITLE_Q_404; ?>
        </title>
    </head>
    <body class="pg-404">
        <?php include "../reused-components/navbar.php"; ?>
        <h1><?php echo $Q_404_TITLE; ?></h1>
        <form method="post" action="/q">
            <p><input type="submit" value="<?php echo $Q_404_BUTTON_SURVEY_HOME; ?>" class="btn-404" /></p>
        </form>
        <?php include "../reused-components/footer.php"; ?>
    </body>
</html>