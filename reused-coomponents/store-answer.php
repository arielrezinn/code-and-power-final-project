<?php

// If there was a previous question, then the POST will have data about that question.
// In that case, we need to store the result of that previous question before we display this one.
if (isset($_POST["userID"]) && isset($_POST["questionNumber"]) && isset($_POST["question"]) && isset($_POST["answer"])){
    
    include "../reused-components/dbinfo.php";
    
    // Prepare our query
    $query = $conn->prepare("INSERT INTO `group1final-spring2021` (userID, questionNumber, question, answer) VALUES (?, ?, ?, ?)");
    $query->bind_param("iisi", $_POST["userID"], $_POST["questionNumber"], $_POST["question"], $_POST["answer"]);
    
    // Run the query to store the result of the previous question
    $query->execute();
    
    // Close the query and connection since we're done with them
    $query->close();
    $conn->close();
}

?>