<?php include_once "constants.php"; ?>
<link rel="stylesheet" type="text/css" href="../commonstyle.css">
<div class="nav-ul">
    <a class="nav-li" href="../">Home</a>
    <a class="nav-li" href="../q"><?php echo $NAV_SURVEY; ?></a>
    <a class="nav-li" href="../results"><?php echo $NAV_RESULTS; ?></a>
    <a class="nav-li" href="../a11y-resources"><?php echo $NAV_RESOURCES; ?></a>
    <a class="nav-li" href="../results/analysis.php"><?php echo $NAV_ANALYSIS; ?></a>
    <!-- Dropdown code modified from: https://www.w3schools.com/howto/howto_css_dropdown.asp -->
    <div class="dropdown">
        <button class="dropbtn nav-li"><?php echo $NAV_REFLECTIONS; ?> 
        </button>
        <div class="dropdown-content" id="myDropdown">
            <a class="nav-li" href="../reflections/charles.php">Charles</a>
            <a class="nav-li" href="../reflections/ariel.php">Ariel</a>
            <a class="nav-li" href="../reflections/toma.php">Toma</a>
            <a class="nav-li" href="../reflections/michael.php">Michael</a>
        </div>
    </div>
</div>