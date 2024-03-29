<?php

/* To have a strict use of variable types */
declare(strict_types=1);

namespace App\model;

use App\entity\User;
use App\model\Model;
use \PDO;

class UserModel extends Model 
{

    private const USER_CLASS = 'App\entity\User'; 

    public function userCreation(User $user) : bool 
    {

        $statement = $this->connection->prepare("INSERT INTO user(name, nickname, username, password, mail, phonenumber, account_key) VALUES(:name, :nickname, :username, :password, :mail, :phonenumber, :account_key)");

        $line = $statement->execute([
            'name' => $user->getName(),
            'nickname'=> $user->getNickname(),
            'username' => $user->getUsername(),
            'password'=> password_hash($user->getPassword(), PASSWORD_DEFAULT),
            'mail'=> $user->getMail(),
            'phonenumber'=> $user->getPhoneNumber(),
            'account_key' => $user->getAccountKey()
        ]);

        return ($line);
    } 

    public function getUserInformations(array $formInput) : ?User
    {
        $statement = $this->connection->prepare("SELECT * FROM `user` WHERE `mail` = :mail");
        $statement->execute(
            [
                'mail' => $formInput['mail'],
            ]);
        $users = $statement->fetchAll();

        if(count($users) === 0) {
            return null;
        } 

        foreach ($users as $user) {
            if(password_verify($formInput['password'], $user['password'])) {
                $user['id']=(int)$user['id'];
                $userInformations = new User($user);
                return $userInformations;
            }
        }
        return null;
    }

    public function userPseudoCheck(User $user) : int
    {
        $statement = $this->connection->prepare("SELECT * FROM user WHERE username = ?");
        $statement->execute([$user->getUsername()]);
        $countPseudo = $statement->rowCount();
        return $countPseudo;
    }

    public function userMailCheck(User $user) : int
    {
        $statement = $this->connection->prepare("SELECT * FROM user WHERE mail = ?");
        $statement->execute([$user->getMail()]);
        $countMail = $statement->rowCount();
        return $countMail;
    }

    // get user informations by username search

    public function getUserSearched(array $username) : ?User 
    {
        $statement = $this->connection->prepare("SELECT * FROM user WHERE username = ?");
        $statement->execute([$username['pseudo']]);
        $statement->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, self::USER_CLASS);
        $userFound = $statement->fetch();

        if($userFound === false) {
            return null;
        }else{
            return $userFound;
        }
    }

    public function modifyUserRole(array $newRole) : bool
    {
        $statement = $this->connection->prepare("UPDATE user SET `role` = :role WHERE `username` = :username");
        $line = $statement->execute([
            'role' => $newRole['role'],
            'username' => $newRole['username']
        ]);
        return $line;
    }

    public function validateAccount(string $accountKey) : bool 
    {
        $user = $this->connection->prepare("SELECT * FROM user WHERE `account_key` = ?");
        $user->execute([$accountKey]);
        $user->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, self::USER_CLASS);
        $userFound = $user->fetch();
        
        if($userFound) {
            $statement = $this->connection->prepare("UPDATE user SET `validate_account` = 1, `account_key` = null WHERE `account_key` = ?");
            $line = $statement->execute([$accountKey]);
            return $line;
        }else{
            return false;
        }
    }

    public function getUserByMailCheck(string $userMail) : ?User
    {
        $user = $this->connection->prepare("SELECT * FROM user WHERE `mail` = ?");
        $user->execute([$userMail]);
        $user->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, self::USER_CLASS);
        $userFound = $user->fetch();
        
        if($userFound === false) {
            return null;
        }else{
            return $userFound;
        }

    }

    public function accountCheck(string $accountKey) : ?User 
    {
        $user = $this->connection->prepare("SELECT * FROM user WHERE `account_key` = ?");
        $userFound = $user->execute([$accountKey]);
        $user->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, self::USER_CLASS);
        $userFound = $user->fetch();
        if($userFound != null) {
            $userFound->setAccountKey($accountKey);
            return $userFound;
        }else{
            return null;
        }
        
    }

    public function passwordChange(string $password, string $userMail) : bool 
    {
        $passwordChange = $this->connection->prepare("UPDATE user SET `password` = :password, `account_key` = null WHERE `mail` = :mail");
        $success = $passwordChange->execute([
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'mail' => $userMail
        ]);
        return $success;
    }

    public function accountKeyGeneration(string $userAccountKey, string $userMail) : bool 
    {
        $accountKey = $this->connection->prepare("UPDATE user SET `account_key` = :account_key WHERE `mail` = :mail");
        $success = $accountKey->execute([
            'account_key' => $userAccountKey,
            'mail' => $userMail
        ]);
        return $success;
    }

    public function userPasswordChangeSecurity(array $userInfo) : ?User
    {
        $checkUser = $this->connection->prepare("SELECT * FROM user WHERE `mail` = :mail AND `account_key` = :account_key");
        $checkUser->execute([
            'account_key' => $userInfo['token'],
            'mail' => $userInfo['email']
        ]);
        $checkUser->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, self::USER_CLASS);
        $userFound = $checkUser->fetch();
        if($userFound != false) {
            return $userFound;
        }else{
            return null;
        }
    }
}
