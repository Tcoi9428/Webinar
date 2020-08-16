<?php


namespace App\Service;


use App\Model\User;

class UserService
{
    private static $salt = 'egn2j35tb.a.qwe';

    public static  function getUserByName(string $username)
    {
        $username = DataBase()->escape($username);
        $query = "SELECT * FROM users WHERE name='$username'";
        return DataBase()->fetchRow($query ,User::class);
    }
    public static function getUserById(int $user_id)
    {
        $query = "SELECT * FROM users WHERE id=$user_id";
        return DataBase()->fetchRow($query , User::class);
    }

    public static function isEmailExist( string $email)
    {
        $email = DataBase()->escape($email);
        $query ="SELECT * FROM users WHERE email='$email'";
        $result = DataBase()->fetchRow($query,User::class);

        return !is_null($result);
    }

    public static function generatePassword($password)
    {
        return self::md5(md5($password));
    }

    private static function md5(string  $string)
    {
        return md5($string . self::$salt);
    }
    public static function save(User $user)
    {
        $user_id = $user->getId();
        if($user_id){
            $user = self::edit($user);
        }else{
            $user = self::create($user);
        }
        return $user;
    }
    public static function create(User $user)
    {
        $data = [
            'name'=>$user->getName(),
            'email'=>$user->getEmail(),
            'password'=>$user->getPassword(),
        ];
       $user_id =  DataBase()->insert('users',$data);

       return self::getUserById($user_id);
    }
    public  static function edit(User $user)
    {
        $user_id = $user->getId();
        if(!$user_id){
            $message = "User doesn't exist";
            throw new \Exception($message);
        }
        $data = [
            'name'=>$user->getName(),
            'email'=>$user->getEmail(),
            'password'=>$user->getPassword(),
        ];
        DataBase()->update('users',$data ,'id='.$user_id);
        return self::getUserById($user_id);
    }
}