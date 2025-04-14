<?php
require_once(dirname(__FILE__) . '/../class/Database.class.php');
class User {
    public $userid, $username, $password, $email;

    public static function getUserByUsername(string $username): ?User {
        $query = Database::prepare("SELECT * FROM `users` WHERE `username`=:username;");
        Database::bindParam($query, ':username', $username);
        Database::execute($query);
        $result = $query->fetchAll();
        if(count($result) == 0) return null;
        $user = new User();
        $user->userid=$result[0]["user_id"];
        $user->username=$result[0]["username"];
        $user->password=$result[0]["password"];
        $user->email=$result[0]["email"];
        return $user;
    }
    public static function getUserByUsernameAndPassword(string $username, string $password): ?User {
        $query = Database::prepare("SELECT * FROM `users` WHERE `username`=:username AND `password`=:password;");
        Database::bindParam($query, ':username', $username);
        Database::bindParam($query, ':password', $password);
        Database::execute($query);
        $result = $query->fetchAll();
        if(count($result) == 0) return null;
        $user = new User();
        $user->userid=$result[0]["user_id"];
        $user->username=$result[0]["username"];
        $user->password=$result[0]["password"];
        $user->email=$result[0]["email"];
        return $user;
    }
    public static function createNewUser(User $user): bool {
        $query = Database::prepare("INSERT INTO `users` (`username`, `password`, `email`) VALUES(:username, :password, :email);");
        Database::bindParam($query, ':username', $user->username);
        Database::bindParam($query, ':password', $user->password);
        Database::bindParam($query, ':email', $user->email);
        return Database::execute($query);
    }
    public static function updateUserPassword(User $user, string $newPassword): bool {
        $query = Database::prepare("UPDATE `users` SET `password`=:password WHERE `username`=:username;");
        Database::bindParam($query, ':password', $newPassword);
        Database::bindParam($query, ':username', $user->username);
        return Database::execute($query);
    }
}
?>
