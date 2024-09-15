<?php
    $pageTitle ='Delete Ward Profile';
    require_once("assets/header.php");
    require_once("assets/db_connect.php");

    // Check if Parent is loggeed in
    if (!isset($_SESSION['parent_id'])) {
        header("Location: parent_login.php");
    }

    // Validate and collect the *Identify with of specific row of student_id
    $student_id = $_GET['sid'];
    $query = 'SELECT * FROM students WHERE student_id = $student_id LIMIT 1';
    $result = mysqli_query($conn, $query);
    
    $student_data = mysqli_fetch_assoc($result);

    // Validate inputs
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $student_id = $_POST['student_id'];
        $student_dp = $_POST['student_dp'];
        $delete_student = $_POST['delete_student'];

        // Validate delete 
        if ($delete_student == "Delete") {
            $query = 'DELETE * FROM student WHERE student_id = $student_id LIMIT 1';
            unlink($student_dp);
            echo "<script>alert('Profile has been deleted')</script>";
            header('Location: parent_ward_display.php');
        } else {
            header("Location: parent_ward_display.php");
        }
    } 
?>

<form action="" method="post">
   <p> Do you want to delete <?= $student_data['firstname']. "-" .$student_data['surname']?></p>
    <i>This process is irriversible</i>
    <input type="hidden" name ="student_id" value="<?=$student_id?>"/>
    <input type="hidden" name="student_dp" value="<?= $student_data['student_dp']?>" />
    <input type="submit" name="delete_student" value="Delete" class="btn btn-danger" />
    <input type="submit" name="dont" value="Dont_delete" class="btn btn-success" />
</form>