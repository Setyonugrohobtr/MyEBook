<?php 
    session_start();
    include "authentication.php";
    include "config.php";

    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $limit = 3;
    $offset = ($page-1)*$limit;
    $sql = "SELECT * FROM users LIMIT $limit OFFSET $offset";
    $query = mysqli_query($link,$sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
<meta charset="utf-8">
    <title>Ngr Ebook login</title>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/style1.css">
	<link href="https://fonts.googleapis.com/css?family=Amaranth" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href='NgrSockDash.ico' rel='shortcut icon'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   
    <style>
        .fas{
            font-size: 20px;
        }
        .fa-edit:hover{
            color: grey;
        }
        .fa-trash:hover{
            color: red;
        }
    </style>
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

<body>
        </p>
        <p class="nav-item text-white">
               </p>
    </nav>


    <div class="container">
        <!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>

}

.topnav {
  overflow: hidden;
  background-color: #e9e9e9;
}

.topnav a {
  float: left;
  display: block;
  color: black;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #2196F3;
  color: white;
}

.topnav .search-container {
  float: left;
}

.topnav input[type=text] {
  padding: 5px;
  margin-top: 8px;
  font-size: 15px;
}

.topnav .search-container button {
  float: right;
  padding: 6px 10px;
  margin-top: 8px;
  margin-right: 16px;
  background: #ddd;
  font-size: 17px;
  border: none;
  cursor: pointer;
}

.topnav .search-container button:hover {
  background: #ccc;
}

@media screen and (max-width: 600px) {
  .topnav .search-container {
    float: none;
  }
  .topnav a, .topnav input[type=text], .topnav .search-container button {
    float: none;
    display: block;
    text-align: left;
    width: 100%;
    margin: 0;
    padding: 14px;
  }
  .topnav input[type=text] {
    border: 1px solid #ccc;  
  }
}
</style>
</head>
<body>

<div class="topnav">
<?php echo isset($_SESSION['login_at']) ? 'Login at: '.$_SESSION['login_at'] : '' ?>  &nbsp;&nbsp;
 
  <div class="search-container">
    <form action="#">
      <input type="text" placeholder="Cari.." name="search">
      <button type="searchtext"><i class="fa fa-search"></i></button>
    </form>
  </div>
</div>


        <div class="text-right"><a href="create.php" class="btn btn-success mb-2"><i class='fas fa-plus'></i> Add Book</a></div>

        <?php if(isset($_SESSION['success'])){ ?>
            <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php } ?>
        <?php if(isset($_SESSION['error'])){ ?>
            <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php } ?>
        <?php if(isset($_SESSION['warning'])){ ?>
            <div class="alert alert-warning"><?php echo $_SESSION['warning']; unset($_SESSION['warning']); ?></div>
        <?php } ?>

        <table class="table table-bordered table-striped table-hover">
            <thead class="bg-light text-center text-dark">
                <tr>
                    <th>Id_buku</th>
                    <th>judul</th>
                    <th>Stok</th>
                    <th>pengarang</th>
                    <th>penerbit</th>
                    <th>gambar</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php if(mysqli_num_rows($query) == 0){ ?>
                    <tr><td colspan="7" class="text-center">No record found</td></tr>
                <?php }else{ 
                    $psql = "SELECT * FROM users";
                    $pquery = mysqli_query($link,$psql);
                    $total_record = mysqli_num_rows($pquery);
                    $total_page = ceil($total_record/$limit);
                    ?>
                    <?php while($row = mysqli_fetch_assoc($query)){ ?>
                    <tr>
                        <td><?php echo $row['id'] ?></td>
                        <td><?php echo $row['name'] ?></td>
                        <td>
                            <?php if($row['sex'] == 'male'){ ?>
                                <i class='-'></i> Avaliable
                            <?php } ?>
                            <?php if($row['sex'] == 'female'){ ?>
                                <i class='-'></i> Not Avaliable
                            <?php } ?>
                        </td>
                        <td><?php echo $row['phone'] ?></td>
                        <td><?php echo $row['email'] ?></td>
                        <td><img src="uploads/<?php echo $row['image'] ?>" width="100" height="125"></td>
                        <td>
                            <a href="update.php?id=<?php echo $row['id'] ?>" class="text-dark"><i class='fas fa-edit'></i></a>&nbsp;&nbsp;
                            <a href="delete.php?id=<?php echo $row['id'] ?>" class="text-dark"><i class='fas fa-trash'></i></a>
                        </td>
                    </tr>
                <?php }} ?>
            </tbody>
        </table>
        <ul class="pagination">
            <li class="page-item <?php echo ($page > 1) ? '' : 'disabled' ?>"><a class="page-link" href="index.php?page=<?php echo $page-1 ?>">Previous</a></li>
        <?php for($i=1;$i<=$total_page;$i++){ ?>
            <li class="page-item <?php echo ($page == $i) ? 'active' : '' ?>"><a class="page-link" href="index.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
        <?php } ?>
            <li class="page-item <?php echo ($total_page > $page) ? '' : 'disabled' ?>"><a class="page-link" href="index.php?page=<?php echo $page+1 ?>">Next</a></li>
        </ul>
        
    </div>
    <div class="button">
      <link rel="stylesheet" type="text/css" href="css/stylecontact.css">
      <form id="contact" action="" method="post">
        <fieldset>
        <text>Copyright &copy; 2021 - Ngr</text>
        </div>
</body>
</html>