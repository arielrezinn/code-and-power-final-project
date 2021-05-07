<?php

include "../reused-components/constants.php";

// Grab the user id from the POST data sent to us from previous page
$userID = $_POST["userID"];

// Store the answer to the previous question, if applicable
include "../reused-components/store-answer.php";

// Time to retreive from the database all data we've collected for this visitor throughout the survey
include "../reused-components/dbinfo.php";

// Define variables for the graphs
$avgPoints = Array();
$individualPoints = Array();

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo $TITLE_RESULTS; ?></title>
        <link rel="stylesheet" type="text/css" href="resultsstyle.css">
    </head>
    <body class="pg-results">
        <?php include "../reused-components/navbar.php"; ?>
        <h1><?php echo $RESULTS_TITLE; ?></h1>
        <div class="container">
            <p><?php echo $RESULTS_INTERPRETATION_INFORMATION; ?></p>
        </div>
        <div class="container">
            <?php 
                // Prepare our query: get all the average results for all questions
                $queryAvg = $conn->prepare("SELECT questionNumber, question, avg(answer) as answer FROM `group1final-spring2021` GROUP BY questionNumber ORDER BY questionNumber");
                
                // Run our query to get the results from the database
                $queryAvg->execute();
                $resultsAvg = $queryAvg->get_result();
                
                if (!empty($userID)) {
                    // Prepare our query: get all the results for this user
                    $queryIndividual = $conn->prepare("SELECT questionNumber, question, answer FROM `group1final-spring2021` WHERE userID = ? ORDER BY questionNumber");
                    $queryIndividual->bind_param("i", $userID);
                    
                    // Run our query to get the results from the database
                    $queryIndividual->execute();
                    $resultsIndividual = $queryIndividual->get_result();
                }
                if (mysqli_num_rows($resultsAvg) > 0) { // from: https://www.php.net/manual/en/function.mysql-num-rows.php
                    // Make the table
                    echo "<table>";
                        echo "<tr>";
                            echo "<th>" . $RESULTS_TBL_Q_NUMBER . "</th>";
                            echo "<th>" . $RESULTS_TBL_QUESTION . "</th>";
                            if (!empty($userID)) {
                                echo "<th>" . $RESULTS_TBL_Q_YOUR_ANSWER . "</th>";
                            }
                            echo "<th>" . $RESULTS_TBL_Q_AVG_ANSWER . "</th>";
                        echo "</tr>";
                        
                        // Loop through and display the results
                        // adapted from: https://www.w3schools.com/php/php_mysql_select.asp
                        while ($rowAvg = $resultsAvg->fetch_assoc()) {
                        if (!empty($userID)) { $rowIndividual = $resultsIndividual->fetch_assoc(); }
                            echo "<tr>";
                                echo "<td>";
                                    $tblQuestionNumber = $rowAvg["questionNumber"] + 1;
                                    echo $tblQuestionNumber;
                                echo "</td>";
                                echo "<td>" . $rowAvg["question"] . "</td>";
                                if (!empty($userID)) { // Only show if the user has taken the survey
                                    echo "<td>";
                                        $roundedIndividualAnswer = round($rowIndividual["answer"],0,PHP_ROUND_HALF_UP);
                                        if ($roundedIndividualAnswer == 1) {
                                            echo $Q_OPT_1;
                                        } else if ($roundedIndividualAnswer == 2) {
                                            echo $Q_OPT_2;
                                        } else if ($roundedIndividualAnswer == 3) {
                                            echo $Q_OPT_3;
                                        } else if ($roundedIndividualAnswer == 4) {
                                            echo $Q_OPT_4;
                                        } else if ($roundedIndividualAnswer == 5) {
                                            echo $Q_OPT_5;
                                        } else {
                                            echo "-";
                                        }
                                    echo "</td>";
                                    array_push($individualPoints, array("x"=>$rowAvg["questionNumber"]+1, "y"=>round($rowIndividual["answer"],0,PHP_ROUND_HALF_UP)));
                                }
                                echo "<td>";
                                    $roundedAvgAnswer = round($rowAvg["answer"],0,PHP_ROUND_HALF_UP);
                                    if ($roundedAvgAnswer == 1) {
                                        echo $Q_OPT_1;
                                    } else if ($roundedAvgAnswer == 2) {
                                        echo $Q_OPT_2;
                                    } else if ($roundedAvgAnswer == 3) {
                                        echo $Q_OPT_3;
                                    } else if ($roundedAvgAnswer == 4) {
                                        echo $Q_OPT_4;
                                    } else if ($roundedAvgAnswer == 5) {
                                        echo $Q_OPT_5;
                                    } else {
                                        echo "-";
                                    }
                                echo "</td>";
                                array_push($avgPoints, array("x"=>$rowAvg["questionNumber"]+1, "y"=>round($rowAvg["answer"],0,PHP_ROUND_HALF_UP)));
                            echo "</tr>";
                        }
                    echo "</table>";
                    echo '<p class="q-definitions" style="text-align: center;"><a href="../a11y-resources" target="_blank">' . $QUESTION_DEFINITIONS . '</a></p>';
                } else {
                    echo "<p style='text-align: center;'>";
                    echo $NO_RESULTS_MESSAGE;
                        echo '<form method="post" action="/q" style="text-align: center;">';
                            echo '<input type="submit" value="' . $HOMEPAGE_BUTTON_GOTO . '" class="btn-homepage" />';
                        echo '</form>';
                    echo "</p>";
                    echo "<style>.pg-results .footer { position: absolute; bottom: 0; }</style>"; // special styling to put the footer on the bottom of the results page when there are no results yet
                }
            ?>
        </div>
        
        <?php if (mysqli_num_rows($resultsAvg) > 0) { ?>
            <!--Graph Setup-->
            <!--revised from https://canvasjs.com/php-charts/chart-data-from-database/-->
            <script>
                var yLabels = ["<?php echo $Q_OPT_1; ?>","<?php echo $Q_OPT_2; ?>","<?php echo $Q_OPT_3; ?>","<?php echo $Q_OPT_4; ?>","<?php echo $Q_OPT_5; ?>"];
                window.onload = function() {
                    CanvasJS.addColorSet(
                        "ourTheme",
                        [ //colorSet Array
                        "#ffb5a7",
                        "#fcd5ce",
                        "#f8edeb",
                        "#f9dcc4",
                        "#fec89a",
                        ]
                    );
                    
                    var avgChart = new CanvasJS.Chart("chartContainerAvg", {
                        animationEnabled: true,
                        exportEnabled: false,
                        colorSet: "ourTheme",
                        title: {
                            text: "<?php echo $CHART_AVG_TITLE; ?>",
                            fontFamily: "arial",
                        },
                        toolTip: {
                            enabled: false,
                        },
                        axisY: {
                            // title: "<?php echo $CHART_Y_AXIS; ?>",
                            titleFontSize: 24,
                            fontFamily: "arial",
                            interval: 1,
                            maximum: 5,
                            includeZero: true,
                            labelFormatter: function (e) {
                                var yAvg = yLabels[e.value-1];
                                if (typeof yLabels[e.value-1] !== "undefined") {
                                    return yAvg;
                                } else {
                                    return "";
                                }
                            }
                        },
                        axisX: {
                            title: "<?php echo $CHART_X_AXIS; ?>",
                            titleFontSize: 24,
                            fontFamily: "arial",
                            interval: 1,
                        },
                        data: [{
                            type: "column", // change type to bar, line, area, pie, etc.
                            dataPoints: <?php echo json_encode($avgPoints, JSON_NUMERIC_CHECK); ?>
                        }]
                    });
                    avgChart.render();
                    
                    <?php if(!empty($userID)) { ?>
                        var individualChart = new CanvasJS.Chart("chartContainerIndividual", {
                            animationEnabled: true,
                            exportEnabled: false,
                            colorSet: "ourTheme",
                            title: {
                                text: "<?php echo $CHART_YOUR_TITLE; ?>",
                                fontFamily: "arial",
                            },
                            toolTip: {
                                enabled: false,
                            },
                            axisY: {
                                // title: "<?php echo $CHART_Y_AXIS; ?>",
                                titleFontSize: 24,
                                fontFamily: "arial",
                                interval: 1,
                                maximum: 5,
                                includeZero: true,
                                labelFormatter: function (e) {
                                    var yIndividual = yLabels[e.value-1];
                                    if (typeof yLabels[e.value-1] !== "undefined") {
                                        return yIndividual;
                                    } else {
                                        return "";
                                    }
                                }
                            },
                            axisX: {
                                title: "<?php echo $CHART_X_AXIS; ?>",
                                titleFontSize: 24,
                                fontFamily: "arial",
                                interval: 1,
                            },
                            data: [{
                                type: "column", // change type to bar, line, area, pie, etc.
                                dataPoints: <?php echo json_encode($individualPoints, JSON_NUMERIC_CHECK); ?>
                            }]
                        });
                        individualChart.render();
                    <?php } ?>
                }
            </script>
            
            <!--Average Graph-->
            <div class="container">
                <div id="chartContainerAvg" style="height: 370px; width: 100%;"></div>
            </div>
            
            <!--Individual Graph-->
            <?php if(!empty($userID)) { ?>
                <div class="container">
                    <div id="chartContainerIndividual" style="height: 370px; width: 100%;"></div>
                </div>
            <?php } ?>
            
            <?php
                // $queryAvg->close();
                // $queryIndividual->close();
            ?>
            <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        <?php } ?>
        
        <?php include "../reused-components/footer.php"; ?>
    </body>
</html>