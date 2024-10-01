<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "test";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



// Read
$sql = "SELECT * FROM sections";
$result = $conn->query($sql);

// Update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $sql = "UPDATE sections SET name='$name' WHERE id=$id";
    $conn->query($sql);
}

// Delete
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM sections WHERE id=$id";
    $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>CRUD Application</title>
    <style>
        .slider {
            display: none;
        }
        .active {
            display: block;
        }
        .image-container {
            width: 100%;
            height: 300px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

    </style>
</head>
<body style="background-color: #343a40f7;">

<div class="container">
    <div class="text-center" style="color: whitesmoke;padding-top: 3%;">
        <h4>DelphianicLogic in Action</h4>
        <span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</span>
    </div>
    <br />
    <div class="row">
        
        <div class="col-md-4"  style="background-color: whitesmoke;">
            <nav id="tabList">
                <?php while($row = $result->fetch_assoc()): ?>
                   <button class="btn btn-lg btn-block shadow-lg mb-5 bg-white rounded" >
                        <i class="fa fa-file"></i>
                        <a class="nav-link" data-toggle="tab" href="#slider<?php echo $row['id']; ?>" data-image="images/<?php echo $row['image']; ?>"><?php echo $row['name']; ?></a>
                    </button>
                <?php endwhile; ?>
            </nav>
        </div>
        <div class="col-md-4">
            <div class="tab-content">
                <?php $result->data_seek(0); while($row = $result->fetch_assoc()): ?>
                    <div id="slider<?php echo $row['id']; ?>" class="tab-pane slider <?php $row['id'] ==1?active:w ?>">
                        <div class="image-container" style="background-image: url('images/blue.jpg');"><?php echo $row['description']; ?></div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="image-container" id="imageDisplay">
                
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function(){
        $('.nav-link').click(function(){
            var imageUrl = $(this).data('image');
            $('.slider').removeClass('active');
            $($(this).attr('href')).addClass('active');
            $('#imageDisplay').css('background-image', 'url(' + imageUrl + ')');
        });
    });
</script>

</body>
<footer class="text-center" style="color: whitesmoke;padding-top: 3%;">
      <button class="btnic"><a href="http://localhost/test/"><i class="fa fa-home"></i></a></button>
      <button class="btnic"><a href="http://localhost/test/form.php"><i class="fa fa-bars"></i></a></button>
</footer>
</html>