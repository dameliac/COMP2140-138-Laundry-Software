<?php
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Collect form data
        $issueDescription = $_POST["issue"];
        $submissionTime = date('Y-m-d H:i:s'); // Get the current date and time

        // Store the submitted issue along with the timestamp in a file
        $file = 'submitted_issues.txt';
        file_put_contents($file, "[$submissionTime]  $issueDescription" . PHP_EOL, FILE_APPEND);

        // Set a variable to indicate successful submission
        echo "success";
    } else {
        // Set the variable to false if the form is not submitted
        echo "failure";
    }
?>