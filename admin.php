<?php 

session_start(); // oturumu başlat

// Eğer oturum başlatılmamışsa veya loggedIn değişkeni false ise kullanıcıyı giris.php'ye yönlendir
if (!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] !== true) {
    header("Location: giris.php");
    exit();
}
// Oturum süresi 10 dakikadan fazla geçtiyse loggedIn değişkenini false yap
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 600)) {
    $_SESSION["loggedIn"] = false;
    header("Location: giris.php");
    exit();
}

// Oturum süresi yenile
$_SESSION['last_activity'] = time();

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




// Veritabanından verileri sorgulama
$sql = "SELECT * FROM contacts";
$result = mysqli_query($conn, $sql);

// Sorgu sonucunu kontrol etme
if (mysqli_num_rows($result) > 0) {
    
   

} else {
    echo "0 results";
}



// Veritabanı bağlantısını kapatma
mysqli_close($conn);





?>

<style>
    table {
        width: 100%;
        max-width: 100%;
        margin-bottom: 1rem;
        background-color: #fff;
        border-collapse: collapse;
    }
    
    th, td {
        padding: 0.75rem;
        vertical-align: top;
        border: 1px solid #dee2e6;
    }
    
    th {
        background-color: #f8f9fa;
        font-weight: bold;
    }
    
    tbody tr:nth-of-type(even) {
        background-color: #f8f9fa;
    }
</style>

<table class="table">
    <thead>
        <tr>
            <th scope="col">Ad Soyad</th>
            <th scope="col">E-posta</th>
            <th scope="col">Konu</th>
            <th scope="col">Mesaj</th>
            <th scope="col">IP Adresi</th>
            <th scope="col">Tarih</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['subject']; ?></td>
                <td><?php echo $row['message']; ?></td>
                <td><?php echo $row['ip_address']; ?></td>
                <td><?php echo $row['created_at']; ?></td>
                
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>