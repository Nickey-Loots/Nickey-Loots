<?php

function logIn()
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    $warning_msg = validateInput($email, $password);

    // dd($email);

    if (empty($warning_msg)) {
        $user = getUser($email);
        if ($user && verifyPassword($password, $user)) {
            setSession($user);
            redirectUser($user);
        } else {
            $warning_msg[] = 'Invalid email or password!';
        }
    }

    return $warning_msg;
}

function validateInput($email, $password)
{
    $warning_msg = [];

    if (empty($email) || empty($password)) {
        $warning_msg['credentials'] = 'Email and password are required!';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $warning_msg['email'] = 'Invalid email format!';
    }

    return $warning_msg;
}

function getUser($email)
{
    $conn = dbConnect();
    $stmt = $conn->prepare('SELECT * FROM users WHERE email = :email');
    $stmt->execute(['email' => $email]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getUserById($id)
{
    $conn = dbConnect();
    $stmt = $conn->prepare('SELECT * FROM users WHERE id = :id');
    $stmt->execute(['id' => $id]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function verifyPassword($password, $user)
{
    return password_verify($password, $user['password']);
}

function setSession($user)
{
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['email'] = $user['email'];
}

function redirectUser($user)
{
    if ($user['role'] === 'admin') {
        header('Location: /admin/?page=products');
        exit;
    } else if ($user['role'] === 'user') {
        header('Location: ?page=home');
        exit;
    }
}


function validateRegisterInput($email, $password, $confirm_password)
{
    $warning_msg = [];
    if (empty($email) || empty($password) || empty($confirm_password)) {
        $warning_msg[] = 'Email, password, and confirm password are required!';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $warning_msg[] = 'Invalid email format!';
    } else if (strlen($password) < 8) {
        $warning_msg[] = 'Password should be at least 8 characters!';
    } else if ($password != $confirm_password) {
        $warning_msg[] = 'Passwords do not match!';
    }
    return $warning_msg;
}

function checkUserExists($conn, $email)
{
    $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
    $select_user->execute([$email]);
    return $select_user->rowCount() > 0;
}

function registerUser($conn, $email, $password, $role)
{
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $insert_user = $conn->prepare("INSERT INTO `users` (email, password, role) VALUES (?, ?, ?)");
    $insert_user->execute([$email, $hashed_password, $role]);
}

function logOut()
{
    if (isset($_POST['logout'])) {
        if (isset($_SESSION['user_id'])) {
            unset($_SESSION['user_id']);
        }

        header('Location: /?page=login');
        exit;
    }
}

function isLoggedIn($redirect = null)
{
    if (!isset($_SESSION['user_id'])) {
        if (!is_null($redirect)) {
            header("location: " . $redirect);
        }
    }

    return isset($_SESSION['user_id']);
}

function isAdmin()
{
    if (isset($_SESSION['user_id'])) {
        $user = getUser($_SESSION['email']);
        return $user['role'] === 'admin';
    }
    return false;
}
