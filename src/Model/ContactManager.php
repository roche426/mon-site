<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 07/03/18
 * Time: 20:52
 * PHP version 7
 */

namespace Model;

/**
 * Abstract class handling default manager.
 */
class ContactManager extends AbstractManager
{
    const TABLE = 'contact';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function addMessage(array $contact)
    {
        // prepared request
        $statement = $this->pdoConnection->prepare("INSERT INTO  $this->table SET `firstname`=:firstName, `lastname`=:lastName, 
            `email`=:email, `phone`=:numberPhone, `message`=:messageContact , `date`=:dateMessage");
        $statement->bindValue('firstName', $contact['firstName'], \PDO::PARAM_STR);
        $statement->bindValue('lastName', $contact['lastName'], \PDO::PARAM_STR);
        $statement->bindValue('email', $contact['mail'], \PDO::PARAM_STR);
        $statement->bindValue('messageContact', $contact['message'], \PDO::PARAM_STR);
        $statement->bindValue('numberPhone', $contact['phoneNumber'], \PDO::PARAM_STR);
        $statement->bindValue('dateMessage', $contact['date'], \PDO::PARAM_STR);
        $statement->setFetchMode(\PDO::FETCH_CLASS, $this->className);
        $statement->execute();
    }

    public function deleteContact($id)
    {
        // prepared request
        $statement = $this->pdoConnection->prepare("DELETE FROM  $this->table WHERE `id`=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->setFetchMode(\PDO::FETCH_CLASS, $this->className);
        $statement->execute();
    }
}
