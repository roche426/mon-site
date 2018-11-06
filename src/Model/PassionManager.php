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
class PassionManager extends AbstractManager
{
    const TABLE = 'passion';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function addPassion(array $passion)
    {
        // prepared request
        $statement = $this->pdoConnection->prepare("INSERT INTO  $this->table SET `name`=:runningName, `running_time`=:runningTime,
          `rank`=:rank, `participants`=:participants , `date`=:dateRunning, `distance`=:distance");
        $statement->bindValue('runningName', $passion['runningName'], \PDO::PARAM_STR);
        $statement->bindValue('runningTime', $passion['runningTime'], \PDO::PARAM_STR);
        $statement->bindValue('rank', $passion['rank'], \PDO::PARAM_INT);
        $statement->bindValue('participants', $passion['participants'], \PDO::PARAM_INT);
        $statement->bindValue('distance', $passion['distance'], \PDO::PARAM_INT);
        $statement->bindValue('dateRunning', $passion['dateRunning'], \PDO::PARAM_STR);
        $statement->setFetchMode(\PDO::FETCH_CLASS, $this->className);
        $statement->execute();
    }

    public function editPassion(array $passion, string $id)
    {
        // prepared request
        $statement = $this->pdoConnection->prepare("UPDATE  $this->table SET `name`=:runningName, `running_time`=:runningTime,
          `rank`=:rank, `participants`=:participants , `date`=:dateRunning, `distance`=:distance WHERE `id`=:id");
        $statement->bindValue('runningName', $passion['runningName'], \PDO::PARAM_STR);
        $statement->bindValue('runningTime', $passion['runningTime'], \PDO::PARAM_STR);
        $statement->bindValue('rank', $passion['rank'], \PDO::PARAM_INT);
        $statement->bindValue('participants', $passion['participants'], \PDO::PARAM_INT);
        $statement->bindValue('distance', $passion['distance'], \PDO::PARAM_INT);
        $statement->bindValue('dateRunning', $passion['dateRunning'], \PDO::PARAM_STR);
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->setFetchMode(\PDO::FETCH_CLASS, $this->className);
        $statement->execute();
    }

    public function deletePassion($id)
    {
        // prepared request
        $statement = $this->pdoConnection->prepare("DELETE FROM  $this->table WHERE `id`=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->setFetchMode(\PDO::FETCH_CLASS, $this->className);
        $statement->execute();
    }

    /*public function selectAllByDate()
    {
        $statement = $this->pdoConnection->prepare("SELECT * FROM $this->table ORDER BY 'date' DESC");
        $statement->setFetchMode(\PDO::FETCH_CLASS, $this->className);
        $statement->execute();

        return $statement->fetch();
    }*/

    public function selectAllByDate(): array
    {
        // prepared request
        $statement = $this->pdoConnection->prepare("SELECT * FROM $this->table ORDER BY `date` DESC");
        $statement->setFetchMode(\PDO::FETCH_CLASS, $this->className);
        $statement->execute();

        return $statement->fetchAll(); 
       }
}
