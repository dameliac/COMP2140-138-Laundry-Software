<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel</title>
  <link rel="stylesheet" href="maint.css">
</head>
<body>

  <h2>Admin Panel - Submitted Issues</h2>

  <?php
  // Read and display submitted issues from the file
  $file = 'submittedIssues.txt';

  if (file_exists($file)) {
    $submittedIssues = file_get_contents($file);
    echo "<p>Submitted Issues:</p>";
    echo "<ul>";
    foreach ($issuesArray as $issue) {
        echo "<li>$issue</li>";
    }
    echo "</ul>";
} else {
    echo "<p>No submitted issues yet.</p>";
}
?>

</body>
</html>
