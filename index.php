<?php

//1 faire en sorte que notre UserDAO quand il enregistre un nouvel utilisateur, il hash son pass grâce à password_hash et le stock en DB

//2 Créer un mini formulaire de login

//3 Au login, vérifier que le mdp est correct grâce à password verify

//4 Ajouter un pepper

session_start();
include 'user.php';
include 'DAO.php';
include 'UserManager.php';

$user_manager = new UserManager();

if(isset($_POST) && isset($_POST['type']) && $_POST['type'] == 'createUser') {
    $user = $user_manager->save($_POST);
}
?>
<html>
<head>
</head>
<body>
  <form action="index.php" method="post">
      <input type="hidden" name="type" value="createUser">
      Username : <input type="text" name="username">
      Password : <input type="text" name="password">
      <input type="submit">
  </form>

<form action="index.php" method="post" id="login">
Username : <input type="text" name="username">
Mot de passe : <input type="password" name="pwd">
<input type="Submit" name="login">
</form>

</body>
</html>
