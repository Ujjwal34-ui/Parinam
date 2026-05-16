<?php
include 'db.php';

$message = "";

$students = mysqli_query($conn,"SELECT * FROM students");

if(isset($_POST['submit'])){

    $student_id = $_POST['student_id'];
    $subject = $_POST['subject'];
    $marks = $_POST['marks'];

    $sql = "INSERT INTO results(student_id,subject,marks)
            VALUES('$student_id','$subject','$marks')";

    if(mysqli_query($conn,$sql)){
        $message = "<div class='success'>Result Added Successfully!</div>";
    }else{
        $message = "<div class='error'>Error Adding Result!</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Result</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<h2>Add Result</h2>

<?php echo $message; ?>

<form method="POST">

<select name="student_id" required>

<option value="">Select Student</option>

<?php while($row = mysqli_fetch_assoc($students)){ ?>

<option value="<?php echo $row['id']; ?>">
<?php echo $row['name']; ?>
</option>

<?php } ?>

</select>

<input type="text" name="subject" placeholder="Subject" required>

<input type="number" name="marks" placeholder="Marks" required>

<button type="submit" name="submit">Add Result</button>

</form>

<a class="back-btn" href="index.php">Back</a>

</div>

</body>
</html>