<?php


namespace App\Controller;


use App\Service\MailerService;
use App\Service\RequestService;
use App\Service\UserService;
use mysql_xdevapi\Exception;

class User
{
    private function __construct()
    {
    }

    public static function login()
    {
        $login = RequestService::getStringFromPost('login');
        $password = RequestService::getStringFromPost('password');

        /**
         * @var $user \App\Model\User
         */

        $user = UserService::getUserByName($login);

        $error_message= "User with login : $login - not found or password incorrect";
        $password = UserService::generatePassword($password);
        if( is_null($user) || $user->getPassword() !== $password){
            echo $error_message;
            exit();
        }

        $_SESSION['user_id'] = $user->getId();
        RequestService::redirect('/');
    }

    public static function logout()
    {
       unset($_SESSION['user_id']);
        RequestService::redirect('/');
    }

    public static function edit()
    {
        $user = user();
        smarty()->assign_by_ref('user', $user);
        smarty()->display('../templates/user/edit.tpl');
    }
    public static function editing()
    {
        $user = user();

        $name = RequestService::getStringFromPost('name');
        $email = RequestService::getStringFromPost('email');
        $password = RequestService::getStringFromPost('password');
        $password_repeat = RequestService::getStringFromPost('password_repeat');
        if($password !== $password_repeat){
            $message = 'Пароли не совпадают';
           die($message);
        }
        $is_email_exist = UserService::isEmailExist($email);
        if ($is_email_exist){
            die('Пользователь с таким email уже зарегистрирован');
        }
        $password = UserService::generatePassword($password);

        $user->setName($name);
        $user->setEmail($email);
        $user->setPassword($password);

        UserService::save($user);
        RequestService::redirect('/');
    }
}