<?php
session_start(); // oturumu başlat

// Şifreniz
$password = "admin";

// Eğer form gönderildiyse
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Girilen şifreyi al
    $enteredPassword = $_POST["password"];
    
    // Şifre doğruysa admin sayfasına yönlendir
    if ($enteredPassword == $password) {
        // Oturum değişkenini ayarla
        $_SESSION["loggedIn"] = true;
        header("Location: admin.php");
        exit();
    } else {
        $errorMessage = "Hatalı şifre! Lütfen tekrar deneyin.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login Sayfası</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
</head>
<body>


	<div class="container">
		<div class="row justify-content-center mt-5">
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">
						<h4>Giriş Yap</h4>
					</div>
					<div class="card-body">
						<form method="post">
							<div class="form-group">
								<label for="password">Şifre</label>
								<input name="password" type="password" class="form-control" id="password" placeholder="Şifrenizi girin">
                                <?php if (isset($errorMessage)) { ?>
                                    <p style="color:red" ><?php echo $errorMessage; ?></p>
                                <?php } ?>
                            </div>
							<button type="submit" class="btn btn-primary">Giriş Yap</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Bootstrap JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>
</html>
