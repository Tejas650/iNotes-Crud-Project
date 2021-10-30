<?php

$insert = false;
$delete = false;
$update = false;

$servername = "localhost";
$username = "root";
$password = "";
$database = "crudtitle";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
  die("Sorry db was not connected " . mysqli_connect_error());
}
if (isset($_GET['delete'])){
  $sno = $_GET['delete'];

  $sql = "DELETE FROM `title` WHERE `title`.`sno` = $sno ";
  $result = mysqli_query($conn, $sql);
  if($result){
    $delete = true;
  }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['snoEdit'])) {

    $sno = $_POST['snoEdit'];
    $title = $_POST['titleEdit'];
    $description = $_POST['descriptionEdit'];

    $sql = "UPDATE `title` SET `title` = '$title' , `description` = '$description'
    WHERE `title`.`sno` = $sno ";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      $update = true;
    }
  } 
  else {
    $name = $_POST['title'];
    $description = $_POST['description'];

    $sql = "INSERT INTO `title` (`title`, `description`) VALUES ('$name', '$description')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
      $insert = true;
    }
    else{
      echo "It could not be inserted due to this error " . mysqli_error($conn);
    }    
  }
}

?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous">
    </script>
  <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  </script>
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();
    });
  </script>
  <title>Project 1 CRUD</title>
</head>

<body>

  <!-- Button trigger modal -->
  <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Edit Modal
  </button> -->

  <!-- Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Note</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/CRUD Project/curd.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="mb-3">
              <label for="title" class="form-label">Title Name</label>
              <input type="text" class="form-control" id="titleEdit" name="titleEdit">
            </div>
            <div class="mb-3">
              <label for="description" class="form-label">Description</label>
              <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3"></textarea>
            </div>

          </div>
          <div class="modal-footer d-block mr-auto">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><img src="/CRUD Project/phplogo.png" height="35px" alt="Error"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link " aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact Us</a>
          </li>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
          </li>
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>

  <?php

  if ($insert) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='aler'>
    <strong>Success!!!</strong> Your Note has been added Successfully.
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
  } 

  ?>

  <?php

  if ($delete) {
    echo "<div class='alert alert-danger alert-dismissible fade show' role='aler'>
    <strong>Deleted!!!</strong> Your Note has been deleted.
    <button type='button' class='btn-close' data-bs-dismiss='alert'   aria-label='Close'></button>
  </div>";
  }
  if ($update) {
  echo "<div class='alert alert-success alert-dismissible fade show' role='aler'>
  <strong>Success!!!</strong> Your Note has been updated.
  <button type='button' class='btn-close' data-bs-dismiss='alert'   aria-label='Close'></button>
  </div>";
  }

  ?>
  <div class="container my-4">
    <h2>iNotes CRUD App</h2>
    <form action="/CRUD Project/curd.php" method="POST">
      <div class="mb-3">
        <label for="title" class="form-label">Title Name</label>
        <input type="text" class="form-control" id="title" name="title">
      </div>
      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
      </div>

      <button type="submit" class="btn btn-primary">Add Note</button>
      <button type="reset" class="btn btn-primary">Reset Note</button>
    </form>
  </div>

  <div class="container my-5">

    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">S.No</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php

        $sql = " SELECT *FROM `title` ";
        $result = mysqli_query($conn, $sql);

        $sno = 0;
        while ($row = mysqli_fetch_assoc($result)) {
          $sno = $sno + 1;
          echo " <tr>
          <th scope='row'>" . $sno . " </th>
          <td>" . $row['title'] . " </td>
          <td>" . $row['description'] . " </td>
          <td> <button class='edit btn btn-sm btn-primary' id=" . $row['sno'] . ">Edit</button> <button class='delete btn btn-sm btn-primary' id=d" . $row['sno'] . ">Delete</button> </td>
        </tr>";
        }
        ?>
      </tbody>
    </table>
    <hr>
  </div>
  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj"
    crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    -->
  <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        tr = e.target.parentNode.parentNode;
        title = tr.getElementsByTagName("td")[0].innerText;
        description = tr.getElementsByTagName("td")[1].innerText;
        console.log(title, description);
        titleEdit.value = title;
        descriptionEdit.value = description;
        snoEdit.value = e.target.id;
        console.log(e.target.id);
        $('#editModal').modal('toggle');

      })
    })

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        sno = e.target.id.substr(1,);
        if (confirm("Are you sure of you want to delete this file!!")) {
          console.log('yes');
          window.location = `/CRUD Project/curd.php?delete=${sno}`; //Given url to go directly on this location
        } else {                                                    //${sno} == This is considered as a variable in JS
          console.log('no');
        }
      })
    })
  </script>
</body>

</html>