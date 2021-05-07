<?php

include "../reused-components/constants.php";

// Grab the user id from the POST data sent to us from previous page
$userID = $_POST["userID"];
$dataPoints = Array();
$userPoints = Array();
$questionNumber = 1;

// Store the answer to the previous question, if applicable
include "../reused-components/store-answer.php";

// Time to retreive from the database all data we've collected for this visitor throughout the survey
include "../reused-components/dbinfo.php";

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo $TITLE_RESULTS; ?></title>
        <link rel="stylesheet" type="text/css" href="resultsstyle.css">
    </head>
    <body class=“pg-results”>
        <?php include "../reused-components/navbar.php"; ?>
        <h1><?php echo $RESULTS_TITLE; ?></h1>
        <div class="container">
            <p><?php echo $RESULTS_INTERPRETATION_INFORMATION; ?></p>
            <p>TODO overall individual results interpretation? (this is in the /results/index.php file)</p>
        </div>
        <div class="container">
            <?php
                if (empty($userID)) {
                    // Prepare our second query: get all the average results for all questions
                    $query = $conn->prepare("SELECT question, avg(answer) as answer FROM `group1final-spring2021` GROUP BY question ORDER BY questionNumber");
                    
                    // Run our query to get the results from the database
                    $query->execute();
                    $results = $query->get_result();
                    
                    // Loop through and display the results
                    
                    // echo '<p>Average results:</p>';
                    //while ($result = $results->fetch_assoc()){
                    //  echo '<p><b>'.$result["question"].':</b> '.$result["answer"].'</p>';
                    //}
                    
                    echo "<table>";
                    echo '<tr>';
                    echo '<th>' . $RESULTS_TBL_Q_NUMBER . '</th>';
        			echo '<th>' . $RESULTS_TBL_QUESTION . '</th>';
        			echo '<th>' . $RESULTS_TBL_Q_AVG_ANSWER . '</th>';
        		    echo '</tr>';
                    
            		#adapted from: https://www.w3schools.com/php/php_mysql_select.asp
        			while($row = $results->fetch_assoc()) {
        				echo '<tr>';
        				echo '<td>' . $questionNumber . '</td>';
        				echo '<td>' . $row["question"] . '</td>';
        				echo '<td>';
        				$roundedAnswer = round($row["answer"],0,PHP_ROUND_HALF_UP);
        				if ($roundedAnswer == 1) {
        				    echo $Q_OPT_1;
        				} else if ($roundedAnswer == 2) {
        				    echo $Q_OPT_2;
        				} else if ($roundedAnswer == 3) {
        				    echo $Q_OPT_3;
        				} else if ($roundedAnswer == 4) {
        				    echo $Q_OPT_4;
        				} else if ($roundedAnswer == 5) {
        				    echo $Q_OPT_5;
        				} else {
        				    echo "-";
        				}
        				echo '</td>';
        				echo '</tr>';
        				array_push($dataPoints, array("x"=>$questionNumber, "y"=>round($row["answer"],0,PHP_ROUND_HALF_UP)));
        				$questionNumber+=1;
        			}
        			echo '</table>';
                    // Close the query
                    $query->close();
                } else {
                    $query2 = $conn->prepare("SELECT question, avg(answer) as answer FROM `group1final-spring2021` GROUP BY question ORDER BY questionNumber");
                
                    // Run our query to get the results from the database
                    $query2->execute();
                    $results2 = $query2->get_result();
                    
                    // Prepare our first query: get all the results for this particular user
                    $query = $conn->prepare("SELECT question, answer FROM `group1final-spring2021` WHERE userID = ? ORDER BY questionNumber");
                    $query->bind_param("i", $userID);
                    
                    // Run our query to get the results from the database
                    $query->execute();
                    $results = $query->get_result();
                    echo "<table>";
        		    echo '<tr>';
                    echo '<th>' . $RESULTS_TBL_Q_NUMBER . '</th>';
        			echo '<th>' . $RESULTS_TBL_QUESTION . '</th>';
        			echo '<th>' . $RESULTS_TBL_Q_YOUR_ANSWER . '</th>';
        			echo '<th>' . $RESULTS_TBL_Q_AVG_ANSWER . '</th>';
        		    echo '</tr>';
        		    
                    if (sizeof($results->fetch_assoc()) > 0) { // This makes the "your results" section not appear if the user goes directly to the results page without taking the survey
                        // Loop through and display the results
                        // echo '<p>Your results:</p>';
                        while ($row = $results->fetch_assoc()){
                            $ave = $results2->fetch_assoc();
                            echo '<tr>';
                            echo '<td>' . $questionNumber . '</td>';
            				echo '<td>' . $row["question"] . '</td>';
            				echo '<td>';
            				$userAnswer = $row["answer"];
            				if ($userAnswer == 1) {
            				    echo $Q_OPT_1;
            				} else if ($userAnswer == 2) {
            				    echo $Q_OPT_2;
            				} else if ($userAnswer == 3) {
            				    echo $Q_OPT_3;
            				} else if ($userAnswer == 4) {
            				    echo $Q_OPT_4;
            				} else if ($userAnswer == 5) {
            				    echo $Q_OPT_5;
            				} else {
            				    echo "-";
            				}
            				echo '</td>';
            				echo '<td>';
            				$roundedAvgAnswer = round($ave["answer"],0,PHP_ROUND_HALF_UP);
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
            				echo '</td>';
            				echo '</tr>';
            				array_push($dataPoints, array("x"=>$questionNumber, "y"=>round($ave["answer"],0,PHP_ROUND_HALF_UP)));
            				array_push($userPoints, array("x"=>$questionNumber, "y"=>round($row["answer"],0,PHP_ROUND_HALF_UP)));
            				$questionNumber+=1;
                        }
                    }
                    $query->close();
        			echo '</table>';
                }
            ?>
        </div>

        <!--revised from https://canvasjs.com/php-charts/chart-data-from-database/-->
        
        <?php if(!empty($userPoints)) : ?>
                <!-- //revised based on https://canvasjs.com/php-charts/chart-data-from-database/-->
                <script>
                var yLabels = ["<?php echo $Q_OPT_1; ?>","<?php echo $Q_OPT_2; ?>","<?php echo $Q_OPT_3; ?>","<?php echo $Q_OPT_4; ?>","<?php echo $Q_OPT_5; ?>"];
                window.onload = function () {
                CanvasJS.addColorSet("ourtheme",
                [//colorSet Array
                "#ffb5a7",
                "#fcd5ce",
                "#f8edeb",
                "#f9dcc4",
                "#fec89a",
                ]);
                var chart2 = new CanvasJS.Chart("chartContainer2", {
                	animationEnabled: true,
                	exportEnabled: true,
                // 	theme: "light1", // "light1", "light2", "dark1", "dark2"
                    colorSet: "ourtheme",
                	title:{
                		text: "<?php echo $CHART_YOUR_TITLE; ?>",
                		fontFamily: "arial",
                	},
                	toolTip:{
                       enabled: false,
                    },
                	axisY: {
                // 	    title: "<?php echo $CHART_Y_AXIS; ?>",
                // 		titleFontSize: 24,
                		fontFamily: "arial",
                		interval: 1,
                        labelFormatter: function (e) {      
                          var yDogs = yLabels[e.value-1];
                          if(typeof yLabels[e.value-1] !== "undefined"){
                              return yDogs;
                          }else{
                              return "";
                          }
                        }
                	},
                	axisX: {
                		title: "<?php echo $CHART_X_AXIS; ?>",
                		titleFontSize: 24,
                		fontFamily: "arial",
                	},
                	data: [{
                		type: "column", //change type to bar, line, area, pie, etc  
                		dataPoints: <?php echo json_encode($userPoints, JSON_NUMERIC_CHECK); ?>
                	}]
                });
                var chart = new CanvasJS.Chart("chartContainer", {
                	animationEnabled: true,
                	exportEnabled: true,
                // 	theme: "light1", // "light1", "light2", "dark1", "dark2"
                    colorSet: "ourtheme",
                	title:{
                		text: "<?php echo $CHART_AVG_TITLE; ?>",
                		fontFamily: "arial",
                	},
                	toolTip:{
                       enabled: false,
                    },
                	axisY: {
                // 		title: "<?php echo $CHART_Y_AXIS; ?>",
                // 		titleFontSize: 24,
                		fontFamily: "arial",
                		interval: 1,
                        labelFormatter: function (e) {      
                          var yCats = yLabels[e.value-1];
                          if (typeof yLabels[e.value-1] != "undefined") {
                            return yCats;
                          }else{
                              return "";
                          }
                        }
                	},
                	axisX: {
                	    fontFamily: "arial",
                		title: "<?php echo $CHART_X_AXIS; ?>",
                		titleFontSize: 24,
                	},
                	data: [{
                		type: "column", //change type to bar, line, area, pie, etc  
                		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                	}]
                });
                chart.render();
                chart2.render();
                 
                }
                </script>
                <div class="container">
                <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                </div><div class="container">
                <div id="chartContainer2" style="height: 370px; width: 100%;"></div>
                <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
            </div>
        <?php else : ?>
            <div class="container">
                <!-- //revised based on https://canvasjs.com/php-charts/chart-data-from-database/-->
                <script>
                var yLabels = ["<?php echo $Q_OPT_1; ?>","<?php echo $Q_OPT_2; ?>","<?php echo $Q_OPT_3; ?>","<?php echo $Q_OPT_4; ?>","<?php echo $Q_OPT_5; ?>"];
                window.onload = function () {
                CanvasJS.addColorSet("ourtheme",
                [//colorSet Array
                "#ffb5a7",
                "#fcd5ce",
                "#f8edeb",
                "#f9dcc4",
                "#fec89a",
                ]);
                var chart = new CanvasJS.Chart("chartContainer", {
                	animationEnabled: true,
                	exportEnabled: true,
                // 	theme: "light1", // "light1", "light2", "dark1", "dark2"
                    colorSet: "ourtheme",
                	title:{
                		text: "<?php echo $CHART_AVG_TITLE; ?>",
                		fontFamily: "arial",
                	},
                	toolTip:{
                       enabled: false,
                    },
                	axisY: {
                // 		title: "<?php echo $CHART_Y_AXIS; ?>",
                // 		titleFontSize: 24,
                		fontFamily: "arial",
                		interval: 1,
                        labelFormatter: function (e) {      
                          var yCats = yLabels[e.value];
                          return yCats;
                        }
                	},
                	axisX: {
                		title: "<?php echo $CHART_X_AXIS; ?>",
                		titleFontSize: 24,
                		fontFamily: "arial",
                	},
                	data: [{
                		type: "column", //change type to bar, line, area, pie, etc  
                		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                	}]
                });
                chart.render();
                 
                }
                </script>
                <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
            </div>
        <?php endif; ?>
        <?php include "../reused-components/footer.php"; ?>
    </body>
</html>