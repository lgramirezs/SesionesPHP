<?php

session_start();

if (isset($_SESSION['user'])) {
    header('Location: index.php');
}

$errors = [];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = filter_var(strtolower($_POST['user']), FILTER_SANITIZE_STRING);
    $password = $_POST['password'];
    $confirmpassword =$_POST['confirmpassword'];

    if (empty($user)) {
        array_push($errors, 'Debe especificar un nombre');
    }

    if (empty($password)) {
        array_push($errors, 'Debe especificar una contraseña');
    } else {
        $password = hash('sha512', $password);
    }

    if (empty($confirmpassword)) {
        array_push($errors, 'Debe confirmar la contraseña');
    } else {
        $confirmpassword = hash('sha512', $confirmpassword);
        //
        if ($confirmpassword !== $password) {
            array_push($errors, 'Las contraseñas deben coincidir');
        }
    }

    if (empty($errors) && $_POST) {
        try {
            $data = new PDO('mysql:host=localhost;dbname=;', 'user', 'password');
            $statement = $data->prepare('SELECT * FROM usuarios WHERE user = :user LIMIT 1');
            $statement->execute(array(':user' => $user));
            $result = $statement->fetch();
            // 
            if (!$result) {
                $record_statement = $data->prepare('INSERT INTO usuarios(`user`,pass) VALUES(:user,:pass);');
                $record_statement->execute(array(':user' => $user, ':pass' => $password));
                $successfully = true;
                header('Location: login.php');
            } else {
                array_push($errors, 'Este usuario ya se encuentra registrado');
            }
        } catch (PDOException $e) {
            echo 'Error' . $e->getMessage();
        }
    }
}

require('./views/sigin.view.php');
