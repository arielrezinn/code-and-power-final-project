<?php

include "./reused-components/constants.php";

// Generate a random userID to use to identify the visitor throughout the survey
$userID = rand(1000000, 9999999);
?>
<!-- Favicon source: https://www.google.com/url?q=https://www.pngfind.com/pngs/m/38-382218_number-one-png-number-1-transparent-background-png.png&sa=D&source=editors&ust=1619728284328000&usg=AOvVaw0TOIJiLXS-nsvGKcc1prsr-->

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>
            <?php echo $TITLE_HOMEPAGE; ?>
        </title>
        <!--<link rel="stylesheet" type="text/css" href="homepagestyle.css">-->
    </head>
    <body class="pg-homepage">
        <?php include "./reused-components/navbar.php"; ?>
        <h1><?php echo $HOMEPAGE_TITLE; ?></h1>
        <div class="container">
            <p><?php echo $HOMEPAGE_WELCOME; ?></p>
            <p><?php echo $HOMEPAGE_INFO; ?></p>
            <p><?php echo $HOMEPAGE_AUDIENCE; ?></p>
            <form method="post" action="q">
                <p><input type="submit" value="<?php echo $HOMEPAGE_BUTTON_GOTO; ?>" class="btn-homepage" /></p>
            </form>
        </div>
        <?php include "./reused-components/footer.php"; ?>
    </body>
</html>