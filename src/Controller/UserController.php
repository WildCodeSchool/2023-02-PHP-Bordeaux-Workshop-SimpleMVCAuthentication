<?php

namespace App\Controller;

use App\Model\UserManager;

class UserController extends AbstractController
{
    public function login(): string
    {


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $userManager = new UserManager();
            $user = $userManager->selectOneByEmail($email);
            //Hash password
            $hashPassword = $user['password'];

            if (password_verify($password, $hashPassword)) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_email'] = $user['email'];
                header('Location: /');
                exit();
            }
        }
        return $this->twig->render('User/login.html.twig');
    }

    public function logout(): void
    {
        unset($_SESSION['user_id']);
        header('Location: /');
    }

    public function register(): string
    {
        //TODO LATER: if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //            $userManager = new UserManager();
        //            $user = $userManager->insert($_POST);
        //        }
        return $this->twig->render('User/register.html.twig');
    }
}
