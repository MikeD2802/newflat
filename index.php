<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Lamp Stack CRUD</title>
  </head>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">LAMP Stack Register Form</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ms-auto">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </div>
      </div>
    </div>
  </nav>  
  <body style="background-color:black">
    <div style="width: 60%; padding-top: 5%;" class="container">
      <?php require_once 'processing.php'; ?>

      <?php 
        if(isset($_SESSION['message'])):
      ?>

      <div class="alert alert-<?=$_SESSION['msg_type']?>">
          <?php 
            echo $_SESSION['message'];
            unset($_SESSION['message']);
          ?>
      </div>
      <?php
        endif
      ?>
      <?php
        $mysqli = mysqli_connect('localhost', 'root', 'root', 'lamplogin') or die(mysqli_connect_error($mysqli));
        $result = mysqli_query($mysqli, "SELECT * FROM data") or die($mysqli->error);
      ?>

      <div class="table-responsive">
        <table class="table table-dark table-bordered border-dark table-hover">
          <thead>
            <tr>
              <th>Email</th>
              <th>Username</th>
              <th colspan="2">Manage</th>
            </tr>
          </thead>
      <?php
        // db assoc array - looping to get all db entries
        while($row = $result->fetch_assoc()): 
      ?>
          <tbody>
            <tr class="table-active">
              <td><?php echo $row['email']; ?></td>
              <td><?php echo $row['username']; ?></td>
              <td>
                <a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-outline-primary" role="button">Edit</a>
                <a href="index.php?delete=<?php echo $row['id']; ?>" class="btn btn-outline-danger" role="button">Delete</a>
              </td>
            </tr>

          <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>

    <div style="width: 60%; padding-top: 6%;" class="container">
      <form action="processing.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>"></input>
        <div class="mb-3">
          <h1 style="color:white">Register Form</h1>
          <label for="email" class="form-label" style="color:white">Email address</label>
          <input name="email" type="email" class="form-control" aria-describedby="emailHelp" placeholder="Email" value="<?php echo $email; ?>">
          <div class="form-text">Please enter valid email address</div>
        </div>
        <div class="mb-3">
          <label for="username" class="form-label" style="color:white">Username</label>
          <input name="username" type="text" class="form-control" aria-describedby="emailHelp"  placeholder="Username" value="<?php echo $username; ?>">
          <div class="form-text">4-100 characters</div>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label" style="color:white">Password</label>
          <input name="password" type="password" class="form-control" placeholder="Password"  value="<?php echo $password; ?>"> 
          <div class="form-text">8-20 characters</div>
        </div>
        <!-- <div class="mb-3 form-check">
          <input type="checkbox" class="form-check-input" id="exampleCheck1">
          <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div> -->
        <?php 
          if($updateRecord == true):
        ?>
            <button type="submit" class="btn btn-outline-primary" name="saveChanges">Save Changes</button>    
        <?php 
          else: 
        ?>
            <button type="submit" class="btn btn-outline-primary" name="submit">Submit</button>
        <?php 
          endif;
        ?>
      </form>
    </div>
  </body>
</html>

