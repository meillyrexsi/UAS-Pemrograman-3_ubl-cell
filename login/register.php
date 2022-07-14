<?php 
 
include '../config/koneksi.php';
 
error_reporting(0);
 
session_start();
 
if (isset($_SESSION['email'])) {
    header("Location:login.php");
}
 
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['cpassword']);
 
    if ($password == $cpassword) {
        $sql = "SELECT * FROM login WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        if (!$result->num_rows > 0) {
            $sql = "INSERT INTO login (email, nama, username, password)
                    VALUES ('$email', '$nama', '$username', '$password')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $email = "";
                $nama = "";
                $username = "";
                $_POST['password'] = "";
                $_POST['cpassword'] = "";
                echo "<script>alert('Selamat, registrasi berhasil!')</script>";
            } else {
                echo "<script>alert('Terjadi kesalahan.')</script>";
            }
        } else {
            echo "<script>alert('Email Sudah Terdaftar.')</script>";
        }
         
    } else {
        echo "<script>alert('Password Tidak Sesuai')</script>";
    }
}
 
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">

    <title>Register</title>
  </head>
  
  <body>
  <div class="half">
    <div class="bg order-1 order-md-2" style="background-image: url('images/bg_1.jpg');"></div>
    <div class="contents order-2 order-md-1">

      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-6">
            <div class="form-block">
              <div class="text-center mb-5">
              <h3>Daftar<strong>Akun</strong></h3>
              <!-- <p class="mb-4">Lorem ipsum dolor sit amet elit. Sapiente sit aut eos consectetur adipisicing.</p> -->
              </div>
              <form action=" " class="signin-form" method="POST">
                    <div class="form-group">
                        <label>E-mail :</label>
		      			<input type="email" class="form-control" name="email" placeholder="E-mail" value="<?php echo $email; ?>" required>
		      		</div>

                    <div class="form-group">
                    <label>Nama :</label>
		      			<input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" value="<?php echo $nama; ?>" required>
		      		</div>

                      <div class="form-group">
                      <label>Username :</label>
		      			<input type="text" class="form-control" name="username" placeholder="Username" value="<?php echo $username; ?>" required>
		      		</div>

                      <div class="form-group">
                      <label>Password :</label>
	              <input id="password-field" type="password" class="form-control"  name="password" placeholder="Password" value="<?php echo $_POST['password']; ?>" required>
	              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
	            </div>

                <div class="form-group">
                <label>Konfirmasi Password :</label>
	              <input id="password-field" type="password" class="form-control" name="cpassword" placeholder="Confirm Password" value="<?php echo $_POST['cpassword']; ?>" required>
	              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
	            </div>
                
                <div class="form-group">
	            	<button type="submit" class="btn btn-block btn-primary" name="submit">Daftar</button>
	            </div>
              </form>
              <center><b><font color="black"><u><a href="login.php">back to menu login</a></u></h6></a></i></b></font></center>
            </div>
          </div>
        </div>
      </div>
    </div>

    
  </div>
    
    

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>