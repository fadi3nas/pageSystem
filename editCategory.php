<?php
require "db.php";

$id = $_GET["id"];

$sql = "SELECT * FROM categories WHERE id='$id'";
$result = mysqli_query($con, $sql);
$category = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];

    $sqlUpdate = "UPDATE categories
                  SET name='$name'
                  WHERE id='$id'";

    mysqli_query($con, $sqlUpdate);

    header("Location: categories.php");
    exit();
}
?>

<form method="POST">

    <input type="text"
           name="name"
           value="<?php echo $category["name"]; ?>">

    <button type="submit">Save Changes</button>

</form>