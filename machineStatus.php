<?php
        session_start();
        $mysqli = new mysqli("localhost", "root", "", "138users");

        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }
        
        $query = $mysqli->prepare("SELECT machineName, machineStatus FROM `machine status`");
        if ($query->execute()) {
            $result = $query->get_result();
            $reservations = array();
            while ($row = $result->fetch_assoc()) {
                $reservations[$row['machineName']] = $row['machineStatus'];
            }
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Machine Statuses</title>
    <link rel="stylesheet" href="laundry.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
    <script src="status.js"></script>
</head>
<body>
    <div class="machineDisplayer">
        <form class="machineDisplay" action="status.php" method="post" onsubmit="machineStatusChange(event)">
            <select name="machine" id="machineSelect">
                <Option value="Machine 1">
                    Machine 1
                </Option>
                <option value="Machine 2">
                    Machine 2
                </option>
                <option value="Machine 3">
                    Machine 3
                </option>
                <option value="Machine 4">
                    Machine 4
                </option>
                <option value="Machine 5">
                    Machine 5
                </option>
            </select>
            <?php for($machine = 1; $machine <= 5; $machine++):
                    $isAvailable = ($reservations["Machine $machine"] == 1)         
                ?>
                <div class="Machine<?=$isAvailable ? " Available" : ""?>">
                    <img src="<?=$isAvailable ? "washing.png" : "washingred.png"?>" alt="Laundry washing" id="machine">
                    <span>Machine <?=$machine;?></span>
                    <div class="commentSection" data-machine-number="<?=$machine?>">
                        <?php if(!$isAvailable): ?>
                            <textarea name="comments" placeholder="Enter your comments here"></textarea>
                            <button type="button" onclick="submitComment(<?=$machine?>)">Submit Comment</button>
                        <?php endif; ?>
                        <div class="commentsDisplay"></div>
                    </div>
                </div>
            <?php endfor;?>
            <button type="submit" class="machineButtons">Toggle Availability</button>
        </form>
        <form class="machineDisplay" action="status.php" method="post" onsubmit="machineStatusChange(event)">
            <select name="machine" id="machineSelect">
                <Option value="Machine 6">
                    Machine 6
                </Option>
                <option value="Machine 7">
                    Machine 7
                </option>
                <option value="Machine 8">
                    Machine 8
                </option>
                <option value="Machine 9">
                    Machine 9
                </option>
                <option value="Machine 10">
                    Machine 10
                </option>
            </select>
            <?php for($machine = 6; $machine <= 10; $machine++):
                    $isAvailable = ($reservations["Machine $machine"] == 1)         
            ?>
                <div class="Machine">
                    <img src="<?=$isAvailable ? "washing.png" : "washingred.png"?>" alt="Laundry washing" id="machine">
                    <span>Machine <?=$machine;?></span>
                    <div class="commentSection" data-machine-number="<?=$machine?>">
                        <?php if(!$isAvailable): ?>
                            <textarea name="comments" placeholder="Enter your comments here"></textarea>
                            <button type="button" onclick="submitComment(<?=$machine?>)">Submit Comment</button>
                        <?php endif; ?>
                        <div class="commentsDisplay"></div>
                    </div>
                </div>
            <?php endfor;?>
            <button type="submit"  class="machineButtons">Toggle Availability</button>
        </form>
    </div>
    <script src="status.js"></script>
</body>
</html>