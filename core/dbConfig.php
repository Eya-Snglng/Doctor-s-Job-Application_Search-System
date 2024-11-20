<?php  
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$host = "localhost";
$user = "root";
$password = "";
$dbname = "application_system";
$dsn = "mysql:host={$host};dbname={$dbname}";

$pdo = new PDO($dsn,$user,$password);
$pdo->exec("SET time_zone = '+08:00';");

?>

<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=application_system', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die(json_encode([
        'message' => 'Database connection failed: ' . $e->getMessage(),
        'statusCode' => 400
    ]));
}
?>
