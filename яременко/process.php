<?php
    require "db.php";

    $id = 0;
    
    $first_name = ''; $last_name = ''; $role = ''; $email = ''; $password = ''; $photo = '';
    $update = false;
    

    if(isset($_POST['signin'])) {
        $result = $mysqli->query("SELECT id, first_name, email, password, role_id FROM users") or die(mysqli_error($mysqli));
        while ($row = $result->fetch_assoc()) {
            if ($row['email'] == $_POST['email'] && $row['password'] == $_POST['password']) {
                $_SESSION['id'] = $row['id'];
                $_SESSION['username'] = $row['first_name'];
                $_SESSION['role'] = $row['role_id'];
            }
        }
        header("Location: main.php");
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $result = $mysqli->query("SELECT user.id, user.first_name, user.last_name, user.email, user.password, user.photo, role.title AS title FROM users user JOIN roles role ON user.role_id = role.id WHERE user.id=$id") or die($mysqli->error);
        while ($row = $result->fetch_assoc()) {
            if($id == $row['id']) {
                $first_name = $row['first_name'];
                $last_name = $row['last_name'];
                $email = $row['email'];
                $password = $row['password'];
                $photo = $row['photo'];
                $role = $row['title'];
                break;
            }
        }
    }

    if (isset($_GET['edit'])) {
        $update = true;
    }

    if (isset($_POST['update'])) { 
        $id = $_POST['id'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $photo = $_FILES['photo']['name'];
        move_uploaded_file($_FILES['photo']['tmp_name'], "assets/img/$photo");

        $mysqli->query("UPDATE users SET first_name='$first_name', last_name='$last_name', email='$email', password='$password', photo='$photo' WHERE id=$id") or die($mysqli->error);
        $update = false;
        $_SESSION['username'] = $first_name;

        header("Location: profile.php?id=$id");
    }

    if(isset($_GET['delete'])) {
        $id = $_GET['delete'];
        
        $mysqli->query("DELETE FROM users WHERE id=$id") or die($mysqli->error);
        header("Location: main.php");
    }

    if(isset($_POST['signup'])) {
        $unique = true;

        $result = $mysqli->query("SELECT email, password FROM users") or die(mysqli_error($mysqli));
        while ($row = $result->fetch_assoc()) {
            if ($row['email'] == $_POST['email']) {
                $unique = false;
                break;
            }
        }

        if ($unique && $_POST['password'] == $_POST['repeatPassword']) {
            unset($_SESSION['errorEmail']);
            unset($_SESSION['errorPassword']);
            $mysqli->query("INSERT INTO users (first_name, last_name, email, password, role_id) VALUES ('{$_POST['first_name']}', '{$_POST['last_name']}', '{$_POST['email']}', '{$_POST['password']}', '{$_POST['role']}')") or die($mysqli->error);
            header("Location: main.php");
        } else if ($unique && $_POST['password'] != $_POST['repeatPassword']) {
            $_SESSION['errorPassword'] = true;
            header("Location: registration.php");
        } else {
            $_SESSION['errorEmail'] = true;
            header("Location: registration.php");
        } 
    }