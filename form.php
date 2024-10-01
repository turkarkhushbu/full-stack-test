<?php include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $name = $_POST['name'];
    $description = $_POST['description'];

    // Handle the file upload
    $targetDir = "images/";  // Specify the directory where the image will be saved
    $filename =  basename($_FILES["image"]["name"]);
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the file is an actual image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".<br>";
        $uploadOk = 1;
    } else {
        echo "File is not an image.<br>";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "Sorry, file already exists.<br>";
        $uploadOk = 0;
    }

    // Check file size (limit to 5MB in this example)
    if ($_FILES["image"]["size"] > 500000) {
        echo "Sorry, your file is too large.<br>";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to  by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.<br>";
    } else {
        // Attempt to move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.<br>";

            // Save to the database
            $sql = "INSERT INTO sections (name, description, image) VALUES ('$name', '$description', '$filename')";
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.<br>";
        }
    }
}
$conn->close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>CRUD Application</title>
</head>
<body style="background-color: #343a40f7;color: whitesmoke;padding-top: 3%;padding-left: 10%;padding-right: 3%;">

<div class="container">
    <h1>Submit Information</h1>
    <div class="row">
    <form action="form.php" method="POST" enctype="multipart/form-data">
        <div class="row">
        <div class="col-md-6">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="col-md-6">
            <label for="description">Description:</label>
            <textarea id="description" name="description" width="100" height="100" required></textarea>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-6">
            <label for="image">Upload Image:</label>
            <input type="file" id="image" name="image" accept="image/*" required>   
        </div>
        <div class="clearfix"></div>
        </div>
        <div class="row">
        <button type="submit" value="create" class="btn btn-lg btn-primary">Add Details</button>
    </div>
    </form>
    </div>
</div>

</body>
<footer style="color: whitesmoke;padding-top: 3%;">
      <button class="btnic"><a href="http://localhost/test/"><i class="fa fa-home"></i></a></button>
      <button class="btnic"><a href="http://localhost/test/form.php"><i class="fa fa-bars"></i></a></button>
</footer>
</html>