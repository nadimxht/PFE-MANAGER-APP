<?php
require_once "connection.php";
session_start();
if($_POST)
{
    extract($_POST);
    if(empty(trim($login)) ||empty(trim($password)))
    {
        $_SESSION['info']= "Champ(s) vide(s) .... "; 
        header("location:index.php");
        exit;
    }
    else
    {
        $login = trim ($_POST['login']);
        $password = trim ($_POST['password']);
        $query = "select * from users where login = '$login' and
        password =md5('$password')";
        //executer la requete
        $result = mysqli_query($con, $query);
        $count = mysqli_num_rows($result);
        echo $count;
       
        if($count ==1)
        {
            
         $row = mysqli_fetch_assoc($result);
         $_SESSION['user'] = $row;
         $role = $row['role']; // retrieve the user's role
        if($role == 'admin') {
            header("location:admin_dashboard.php");
        } else if($role == 'student') {
            header("location:student_dashboard.php");
        } else if($role == 'teacher') {
            header("location:teacher_dashboard.php");
        } else if($role == 'entreprise') {
            header("location:entreprise_dashboard.php");
        } else if($role == 'department_head') {
            header("location:department_head_dashboard.php");
        }
         exit;
        }
        else
        {
            $_SESSION['info']= "login/password not found ";
            header("location:index.php");
            exit;
        }
        
    }


    
    
}//fin if
$info ="";
if(isset($_SESSION['info']))
    $info = $_SESSION['info'];
    
    
    
    unset($_SESSION['info']) ;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <form method ="post" class="login-form">
            <h2>Connexion</h2>
            <label for="">Nom utilisateur</label>
            <input type="text" name="login" id="">
            <label for="">Mot de passe</label>
            <input type="password" name="password" id="">

            <button type="submit">Se connecter</button>

            <?php
            if(!empty($info)) 
            echo "<span>$info</span>";
            ?>
        </form>
    </div>
</body>
</html>