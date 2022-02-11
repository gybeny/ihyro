<?php
session_start();
if(!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "Hibás adat!";
    header('location: index.php');
}

if(isset($_POST['kijelentkezes'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: index.php");
}

$username = $_SESSION['username'];
function FetchErme() {
    $db = mysqli_connect('localhost', 'root', '', 'ihyroregistrations');
    $username = $_SESSION['username'];
    $results = $db->query("SELECT * FROM users WHERE username='$username'");
    if($results->num_rows > 0) {
        while($row = $results->fetch_assoc()) {
            return $row['gamecoin'];
        }
    }
}


function IsAdmin() {
    if($username() == "Balintofficial" || FetchRang() == "IhyroAdmin") {
        return true;
    } else {
        return false;
    }
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>GameNetwork - Admin Editor</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap');
    html, body {
        width: 100% !important;
        margin: 0px;
        padding: 0px;
        font-family: Poppins;
        text-decoration: none;
        color: white;
    }

    body {
        background-color: #131111;
        font-family: Poppins;
        color: white;
    }

    .input-group input {
        background: #3c3c41;
    }

    * {
        color: white;
    }

    .col-12 * {
        border: 1px solid #66c0c4 !important;
    }

    .btn {
        border: none !important;
    }

    .fa {
        border: none !important;
    }

    input {
        outline: hidden;
        border: none !important;
        background: none !important;
        box-shadow: none !important;
    }

    .container {
        margin: 0 !important;
        padding: 0 !important;
        width: 100% !important;
    }

    .col-12 {
        margin: 0 !important;
        padding: 0 !important;
        width: 120% !important;
    }

    .row {
        margin: 0 !important;
        padding: 0 !important;
        width: 119.8% !important;
    }
</style>
<script>
    if(window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
<body>
<div class="container">
    <div class="row">
        <div class="col-12">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Név</th>
                    <th scope="col">Jelszó</th>
                    <th scope="col">Email</th>
                    <th scope="col">GameCoin</th>
                    <th scope="col">Beállítás</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $db = mysqli_connect("localhost", "root", "", "ihyroregistrations");
                if(isset($_POST['delete_'])) {
                    $nameX = $_POST['delete_'];
                    if(!empty($nameX)) {
                        $idX = $_POST['id_'];
                        $db->query("DELETE FROM users WHERE users.username='$nameX'");
                        $dbFix = $db->query("SELECT * FROM users WHERE id>$idX");
                        while($rW = $dbFix->fetch_assoc()) {
                            $fId = $rW['id'];
                            $fId2 = $rW['id'] - 1;
                            $db->query("UPDATE users SET id=$fId2 WHERE users.id=$fId");
                            $db->query("ALTER TABLE users AUTO_INCREMENT=$fId2");
                        }
                    }
                }

                $results = $db->query("SELECT * FROM users");
                while($row = $results->fetch_assoc()) {
                    $name = $row['username'];
                    $pwd = $row['password'];
                    $mail = $row['email'];
                    $id = $row['id'];
                    $coin = $row['gamecoin'];
                    if(isset($_POST['edit_'])) {
                        $eData = $_POST['edit_'];
                        if(!empty($_POST['name_c']) && !empty($_POST['pwd_c'])) {
                            $eName = $_POST['name_c'];
                            $ePassword = $_POST['pwd_c'];
                            $eMail = $_POST['email_c'];
                            $eCoin = $_POST['game_c'];
                            $db->query("UPDATE users SET password='$ePassword' WHERE users.username='$eData'");
                            $db->query("UPDATE users SET username='$eName' WHERE users.username='$eData'");
                            $db->query("UPDATE users SET email='$eMail' WHERE users.username='$eData'");
                            $db->query("UPDATE users SET gamecoin='$eCoin' WHERE users.username='$eData'");
                            header("location: users.php");
                        }

                        if($eData == $name && empty($_POST['name_c']) && empty($_POST['pwd_c']) && empty($_POST['email_c'])) {
                            echo "<form method='POST' style='border: 0 !important;'><tr><th scope='row'>$id</th>
                    <td><input name='name_c' value='$name'></td>
                    <td><input name='pwd_c' value='$pwd'></td>
                    <td><input name='email_c' value='$mail'></td>
                    <td><input name='game_c' value='$coin'></td>
                    <td>
                        <input type='hidden' name='id_' value='$id'>
                        <button type='submit' name='edit_' value='$name' class='btn btn-success'><i class='fa fa-check'></i></button>
                        <button type='submit' name='delete_' value='$name' class='btn btn-danger'><i class='fa fa-trash'></i></button>
                    </form></td></tr>";
                        } else {
                            echo "<tr><th scope='row'>$id</th>
                    <td>$name</td>
                    <td>$pwd</td>
                    <td>$mail</td>
                    <td>$coin</td>
                    <td><form method='POST' style='border: 0 !important;'>
                        <input type='hidden' name='id_' value='$id'>
                        <button type='submit' name='edit_' value='$name' class='btn btn-success'><i class='fa fa-edit'></i></button>
                        <button type='submit' name='delete_' value='$name' class='btn btn-danger'><i class='fa fa-trash'></i></button>
                    </form></td></tr>";
                        }
                    } else {
                        echo "<tr><th scope='row'>$id</th>
                    <td>$name</td>
                    <td>$pwd</td>
                    <td>$mail</td>
                    <td>$coin</td>
                    <td><form method='POST' style='border: 0 !important;'>
                        <input type='hidden' name='id_' value='$id'>
                        <button type='submit' name='edit_' value='$name' class='btn btn-success'><i class='fa fa-edit'></i></button>
                        <button type='submit' name='delete_' value='$name' class='btn btn-danger'><i class='fa fa-trash'></i></button>
                    </form></td></tr>";
                    }
                    
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>