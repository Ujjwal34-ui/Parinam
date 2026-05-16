<?php
include 'db.php';

$message = "";

if(isset($_POST['submit'])){

    $name = trim($_POST['name']);
    $roll = trim($_POST['roll']);
    $class = trim($_POST['class']);

    if(empty($name) || empty($roll) || empty($class)){

        $message = "<div class='error'>All fields are required!</div>";

    } else {

        $sql = "INSERT INTO students(name, roll_number, class)
                VALUES('$name','$roll','$class')";

        if(mysqli_query($conn,$sql)){

            $message = "<div class='success'>
                        Student Added Successfully!
                        </div>";

        } else {

            $message = "<div class='error'>
                        Failed to Add Student!
                        </div>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<h2>Add Student</h2>

<?php echo $message; ?>

<form method="POST">

    <input type="text"
           name="name"
           placeholder="Student Name"
           required>

    <input type="text"
           name="roll"
           placeholder="Roll Number"
           required>

    <input type="text"
           name="class"
           placeholder="Class"
           required>

    <button type="submit" name="submit">
        Add Student
    </button>

</form>

<a class="back-btn" href="index.php">Back</a>

</div>

</body>
</html>