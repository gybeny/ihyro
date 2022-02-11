<?php
session_start();
$db = mysqli_connect("localhost", "root", "", "ihyroregistrations");




if(isset($_POST['regisztracio'])) {
        $result = $db->query("SELECT * FROM users WHERE username='$name'");
$db->query("INSERT INTO users (id, username, email, password) VALUES ('szia', 'szia', 'szia', 'szia'");
}
?>
<h1>Sikeresen lefutattam</h1>