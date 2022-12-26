<?php session_start();


if (isset($_SESSION['user'])) {
    header('Location: index.php');
}

$errors = [];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = filter_var(strtolower($_POST['user']), FILTER_SANITIZE_STRING);
    $password = $_POST['password'];

    if (empty($user)) {
        array_push($errors, 'Debe especificar un nombre');
    }

    if (empty($password)) {
        array_push($errors, 'Debe especificar una contraseña');
    } else {
        $password = hash('sha512', $password);
    }

    if (empty($errors) && $_POST) {
        try {
            $data = new PDO('mysql:host=localhost;dbname=', 'user', 'password');
            $statement = $data->prepare('SELECT * FROM usuarios WHERE user = :user AND pass = :password LIMIT 1');
            $statement->execute(array(':user' => $user, ':password' => $password));
            $user_result = $statement->fetch();
            //  
            if ($user_result) {
                $_SESSION['user'] = $user;
                $successfully = true;
                header('Location: index.php');
            } else {
                array_push($errors, 'Estas credenciales no existen en nuestros registros');
            }
        } catch (PDOException $e) {
            echo 'Error' . $e->getMessage();
        }
    }
}


require('./views/login.view.php');
