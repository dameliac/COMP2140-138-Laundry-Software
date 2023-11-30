<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Submission Confirmation</title>
  <link rel="stylesheet" href="maint.css">
</head>
<body>

  <h2>Submission Confirmation</h2>

  <?php
  // Check if the form is submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $issueDescription = $_POST["issue_description"];
    $submissionTime = date('Y-m-d H:i:s'); // Get the current date and time

    // Store the submitted issue along with the timestamp in a file
    $file = 'submitted_issues.txt';
    file_put_contents($file, "[$submissionTime] $issueDescription" . PHP_EOL, FILE_APPEND);

  <p>Your issue has been successfully submitted. Thank you for reaching out!</p>

</body>
</html>
