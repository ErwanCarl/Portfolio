<?php

/* To have a strict use of variable types */
declare(strict_types=1);

require_once('src/model/Model.php');
require_once('src/entity/User.php');

class UserModel extends Model {

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
        $statement->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'User');
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

    public function validateAccount(string $account_key) : bool 
    {
        $user = $this->connection->prepare("SELECT * FROM user WHERE `account_key` = ?");
        $userFound = $user->execute([$account_key]);
        $user->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'User');
        $userFound = $user->fetch();
        
        if($userFound) {
            $statement = $this->connection->prepare("UPDATE user SET `validateAccount` = 1, `account_key` = null WHERE `account_key` = ?");
            $line = $statement->execute([$account_key]);
            return $line;
        }else{
            return false;
        }
    }
}