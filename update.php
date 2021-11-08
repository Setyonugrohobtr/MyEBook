<?php 
    session_start();
    include "authentication.php";
    include "config.php";

    $id = $_GET['id'];
    $fsql = "SELECT * FROM users WHERE id='$id'";
    $fquery = mysqli_query($link,$fsql);
    $result = mysqli_fetch_assoc($fquery);

    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $sex = $_POST['sex'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $photo = $_FILES['photo'];
        $photo_name = $photo['name'];
        $photo_temp = $photo['tmp_name'];

        move_uploaded_file($photo_temp,'uploads/'.$photo_name);
        
        if(empty($photo_name)){
            $photo_name_old = $result['image'];
            $usql = "UPDATE users SET name='$name',sex='$sex',phone='$phone',email='$email',image='$photo_name_old' WHERE id='$id'";
        }else{
            $usql = "UPDATE users SET name='$name',sex='$sex',phone='$phone',email='$email',image='$photo_name' WHERE id='$id'";
            if($result['image'] != 'avatar.png'){
                $image_path = 'uploads/'.$result['image'];
                unlink($image_path);
            }
        }
        $uquery = mysqli_query($link,$usql);
        if($uquery){
            $log = getHostByName($_SERVER['HTTP_HOST']).' - '.date("F j, Y, g:i a").PHP_EOL.
            "Record updated_".time().PHP_EOL.
            "---------------------------------------".PHP_EOL;
            file_put_contents('logs/log_'.date("j-n-Y").'.log', $log, FILE_APPEND);
            
            $_SESSION['success'] = "One record updated successfully";
            header('location:index.php');
        }else{
            $_SESSION['error'] = "Something is wrong, Record not updated";
            header('location:index.php');
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
    <title>EBook</title>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Tambah Menu</title>
    <link rel="stylesheet" type="text/css" href="css/style1.css">
	<link href="https://fonts.googleapis.com/css?family=Amaranth" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link href='NgrSockDash.ico' rel='shortcut icon'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<nav class="navbar navbar-expand-sm navbar-light">
    <div class="container">
        <a class="navbar-brand" href="index.html"></i>EBook</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            <span class="navbar-toggler-icon"></span>
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a href="menu.html" class="nav-link"><span data-hover="Buku">Daftar</span></a>
                </li>
                <li class="nav-item">
                        
                  <a href="logout.php" class="nav-link"><span data-hover="Keluar">Logout</span></a>
                          </li>
                         
            </ul>

            
        </div>
    </div>
</nav>
    <div class="container">
        <h1 class="text-center">Memperbarui Buku</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name"><strong>judul</strong></label>
                <input type="text" class="form-control" placeholder="Masukan nama" name="name" value="<?php echo $result['name'] ?>" required>
            </div>
            <div class="form-group">
                <label for="email"><strong>Stok</strong></label><br>
                <?php if($result['sex'] == 'male'){ ?>
                    <input type="radio" name="sex" value="male" checked> Tersedia &nbsp;
                    <input type="radio" name="sex" value="female"> Tidak Tersedia
                <?php } ?>
                <?php if($result['sex'] == 'female'){ ?>
                    <input type="radio" name="sex" value="male"> Tersedia &nbsp;
                    <input type="radio" name="sex" value="female" checked> Tidak Tersedia
                <?php } ?>
                <?php if(empty($result['sex'])){ ?>
                    <input type="radio" name="sex" value="male"> Tersedia &nbsp;
                    <input type="radio" name="sex" value="female"> Tidak Tersedia
                <?php } ?>
            </div>
            <div class="form-group">
                <label for="phone"><strong>Pengarang</strong></label>
                <input type="text" class="form-control" placeholder="Masukan harga baru" name="phone" value="<?php echo $result['phone'] ?>" required>
            </div>
            <div class="form-group">
                <label for="email"><strong>Penerbit</strong></label>
                <input type="text" class="form-control" placeholder="Masukan deskripsi" name="email" value="<?php echo $result['email'] ?>" required>
            </div>
            <div class="form-group">
                <label for="photo"><strong>Foto</strong></label><br>
                <input type="file" name="photo">
            </div>
            <div class="text-center mt-5">
                <button type="submit" class="btn btn-primary" name="submit">Perbarui</button>
                <a href="index.php" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>