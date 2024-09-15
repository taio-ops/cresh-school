<?php
    $pageTitle = "Parent Login";
    require_once("assets/header.php");
    require_once("assets/db_connect.php");

    if(!isset($_SESSION['parent_id'])) {
        header("Location: parent_login.php");
    }

    echo "<h1>welcome, " . $_SESSION['firstname'] . "</h1>";
    // echo "<h1>welcome, $_SESSION['firstname']</h1>";
    $student_dp = "";
   if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_dp = $_FILES("student_dp");

        if($student_dp['error'] == 0) {
            $filename = uniqid("student_") . "." . pathinfo($student_dp['name'], PATHINFO_EXTENSION);
            $filelocation = "student_dp/" . $filename;
        } else {
            echo "error uploading file";
        }
    
   }
?>

<style>
    #imagePreview {
        max-width: 200px;
        max-height: 200px;
        border-radius: 5px;
    }
</style>
<form action="" method="post" enctype="multipart/form-data">
    <img src="" alt="File Upload" name="imagePreview" id="imagePreview"/> <br/>
    <input type="file" name="student_dp" id="student_dp" /> <br/>
    <input type="submit" class="btn btn-primary" value="Sign In"/>
</form>

<script>
   const pic = document.getElementById("#imagePreview");
   const upload = document.getElementById("#student_dp");

   

   upload.addEventListener("change", function {
    let file = this.files[0];

    sizeofFile = 4 * 1024 * 1024;

    if(file["type"] == jpg || file["type"] == jpeg || file["type"] == png) {
        if(!(file["size"] > sizeofFile)) {
            const reader = new FileReader();
            reader.onload = function {
                pic.src = reader.result
            } 
            reader.readAsDataURL(file)
        } else {
            alert (file['size'] "+ is greater the 4MB");
            this.value = "";
        }
    } else {
        alert (file['name'] "+ is not accepted");
        this.value = "";
    }
   

   })


</script>