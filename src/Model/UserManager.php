<?php

namespace App\Model;

use PDO;

class UserManager extends AbstractManager
{
    public const TABLE = 'user';

    public function selectOneByEmail(string $email): mixed
    {
        $sql = 'SELECT * FROM user WHERE email = :email';

        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':email', $email, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch();
    }

    public function insert(array $user): int
    {
        $sql = 'INSERT INTO user(email, password, pseudo, firstname, lastname) VALUES(:email, :password, :pseudo, :firstname, :lastname)';
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':email', $user['email'], PDO::PARAM_STR);
        $statement->bindParam(':password', $user['password'], PDO::PARAM_STR);
        $statement->bindParam(':pseudo', $user['pseudo'], PDO::PARAM_STR);
        $statement->bindParam(':firstname', $user['firstname'], PDO::PARAM_STR);
        $statement->bindParam(':lastname', $user['firstname'], PDO::PARAM_STR);
        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }
}
