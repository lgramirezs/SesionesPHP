<?php

session_start();

if (isset($_SESSION['user'])) {
    header('Location: content.php');
} else {
    header('Location: sigin.php');
};
