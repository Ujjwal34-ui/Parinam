<?php
include 'db.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Result</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<h2>Search Result</h2>

<form method="GET">

<input type="text" name="roll" placeholder="Enter Roll Number" required>

<button type="submit">Search</button>

</form>

<?php

if(isset($_GET['roll'])){

    $roll = $_GET['roll'];

    $student = mysqli_query($conn,
        "SELECT * FROM students WHERE roll_number='$roll'");

    if(mysqli_num_rows($student)>0){

        $studentData = mysqli_fetch_assoc($student);

        echo "<div class='result-summary'>";

        echo "<h3>Name: ".$studentData['name']."</h3>";
        echo "<h3>Class: ".$studentData['class']."</h3>";
        echo "<h3>Roll No: ".$studentData['roll_number']."</h3>";

        echo "</div>";

        $student_id = $studentData['id'];

        $results = mysqli_query($conn,
            "SELECT * FROM results WHERE student_id='$student_id'");

        echo "<table>";

        echo "<tr>
                <th>Subject</th>
                <th>Marks</th>
              </tr>";

        $total = 0;
        $count = 0;

        while($row = mysqli_fetch_assoc($results)){

            echo "<tr>";
            echo "<td>".$row['subject']."</td>";
            echo "<td>".$row['marks']."</td>";
            echo "</tr>";

            $total += $row['marks'];
            $count++;
        }

        echo "</table>";

        $percentage = $total / $count;

        if($percentage >= 80){
            $grade = "A";
        }
        elseif($percentage >= 60){
            $grade = "B";
        }
        elseif($percentage >= 40){
            $grade = "C";
        }
        else{
            $grade = "Fail";
        }

        echo "<div class='result-summary'>";

        echo "<h3>Total Marks: $total</h3>";
        echo "<h3>Percentage: $percentage%</h3>";
        echo "<h3>Grade: $grade</h3>";

        echo "</div>";

    }else{

        echo "<div class='error'>Student Not Found!</div>";
    }
}
?>

<a class="back-btn" href="index.php">Back</a>

</div>

</body>
</html>