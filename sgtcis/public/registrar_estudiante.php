<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGTCIS</title>
</head>
<body>
<?php
            $con = mysqli_connect("localhost","root","","sgtcis") or die ("Error");
        ?>
    
    <?php
        if (isset($_POST['registrarse'])) {
            $name = $_POST["name"];    
            $lastname = $_POST["lastname"];    
            $email = $_POST["email"];
            $password = $_POST["password"]; 
            $passHash = password_hash($password, PASSWORD_BCRYPT);
            $is_admin=false;
            $is_docente=false;
            $is_estudiante=true;
            $registrar = "INSERT INTO users (name,lastname,email,password,is_admin,is_docente,is_estudiante) VALUES ('$name','$lastname','$email','$passHash','$is_admin','$is_docente','$is_estudiante')";    
            $ejecutar=mysqli_query($con,$registrar);
            if($ejecutar){
                echo "Inserta correctamente";
            }else{
                echo "";
            }
        }
    ?>
</body>
</html>