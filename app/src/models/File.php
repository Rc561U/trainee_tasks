<?php

namespace Crud\Mvc\models;

use Crud\Mvc\core\Model;

class File extends Model
{
    public function saveUploadFile($name, $size, $meta_data, $path, $weight, $height, $created_date = null,)
    {
        $query = $this->database->prepare("INSERT INTO  `test`.`uploads` (`name`,`size`,`mime`,`path`, `created_date`, `weight`, `height` ) VALUES (:name, :size,:mime,:path, :created_date, :weight, :height)");
        $query->execute([
            "name" => $name,
            "size" => $size,
            "mime" => $meta_data,
            "path" => $path,
            "created_date" => $created_date,
            "weight" => $weight,
            "height" => $height
        ]);

        return $query;
    }

    public function getUploads()
    {
        $result = $this->database->query('SELECT * FROM test.uploads');
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function isFileNameExists($name)
    {
        $sth = $this->database->prepare('SELECT `name` FROM `uploads` WHERE `name` = ?');
        $sth->execute([$name]);
        return $sth->fetch(\PDO::FETCH_ASSOC)['name'] ?? false;
    }
}