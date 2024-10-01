<?php  
// Connect to the database  
$conn = mysqli_connect("localhost", "root", "root", "test");  

// Check connection  
if (!$conn) {  
	die("Connection failed: " . mysqli_connect_error());  
}  
  
// Create a new section  
if (isset($_POST['create'])) {  
$name = $_POST['name'];  
$description = $_POST['description'];  
$image = $_POST['image'];  

$sql = "INSERT INTO sections (name, description, image) VALUES ('$name', '$description', '$image')";  
 if (mysqli_query($conn, $sql)) {  
 echo "Section created successfully!";  
 } else {  
  echo "Error creating section: " . mysqli_error($conn);  
 }  
}  
  
// Read all sections  
if (isset($_GET['read'])) {  
 $sql = "SELECT * FROM sections";  
$result = mysqli_query($conn, $sql);  
 while ($row = mysqli_fetch_assoc($result)) {  
  echo "<div class='section'>";  
  echo "<h2>" . $row['name'] . "</h2>";  
  echo "<p>" . $row['description'] . "</p>";  
  echo "<img src='" . $row['image'] . "' alt='" . $row['name'] . "'>";  
  echo "</div>";  
}  
}  
  
// Update a section  
if (isset($_POST['update'])) {  
 $id = $_POST['id'];  
 $name = $_POST['name'];  
 $description = $_POST['description'];  
 $image = $_POST['image'];  
  
 $sql = "UPDATE sections SET name='$name', description='$description', image='$image' WHERE id='$id'";  
 if (mysqli_query($conn, $sql)) {  
  echo "Section updated successfully!";  
 } else {  
  echo "Error updating section: " . mysqli_error($conn);  
 }  
}  
  
// Delete a section  
if (isset($_POST['delete'])) {  
 $id = $_POST['id'];  
  
 $sql = "DELETE FROM sections WHERE id='$id'";  
 if (mysqli_query($conn, $sql)) {  
  echo "Section deleted successfully!";  
 } else {  
  echo "Error deleting section: " . mysqli_error($conn);  
 }  
}  
  echo "Heyy";
mysqli_close($conn);  
?>
