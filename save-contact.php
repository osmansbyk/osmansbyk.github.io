<?php
$ip_address = $_SERVER['REMOTE_ADDR'];

// Veritabanı bağlantısı yapılacak
$servername = "localhost";
$username = "iletisim_user";
$password = "iletisim_pass";
$dbname = "iletisim";

// Bağlantıyı oluşturma
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Bağlantı hatası kontrolü
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// SQL sorgusu oluşturma
$sql = "INSERT INTO contacts (name, email, subject, message, ip_address) VALUES ('".$_POST['name']."', '".$_POST['email']."', '".$_POST['subject']."', '".$_POST['message']."', '".$ip_address."')";

// Sorguyu veritabanına gönderme ve hata kontrolü
if (mysqli_query($conn, $sql)) {
    header("Location: index.html?messageSent=success");
    exit();

} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Veritabanı bağlantısını kapatma
mysqli_close($conn);

?>
