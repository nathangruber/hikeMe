<!DOCTYPE html>

<html lang="en">
<?php require_once 'includes/header.php';?>

<body>
    <title>hikeMe</title>
     <?php
    if ($admin) {
        require_once'includes/adminNavbar.php';
    } else {
        require_once'includes/navbar.php';
    }
    ?>
    <?php
    if ($logged) {
        echo "Welcome Back, ";
        echo $_SESSION['name'];
    }
    ?>
 <?php
// Because I don’t use PHP often enough to remember it instantly

$opts = array(
  'http'=>array(
    'method'=>"GET",
    'header'=>"X-Mashape-Key: F1piInHfmpmsh4V6tDTrAboircv8p1s3rgAjsnO6TthOVVt9rJ"               
  )
);
$context = stream_context_create($opts);

$file = file_get_contents("https://trailapi-trailapi.p.mashape.com/?q[city_cont]=Milwaukee", false, $context);
$obj = json_decode($file);
print_r(json_decode($res, true));

?>   
    




<?php require_once 'includes/footer.php'; ?>


</body>
</html>