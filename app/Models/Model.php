<?php

namespace App\Models;

use App\Contracts\Models\ModelInterface;
use App\Application;

class Model implements ModelInterface
{
    /**
     * The Database Table of the Model
     *
     * @var string
     */
    public static $table = '';

    /**
     * ID Collum for this Model
     *
     * @var string
     */
    private $idColumn = 'id';

    /**
     * The Attributes for this class
     *
     * @var array
     */
    public $attributes = [];

    /**
     * Determires if the Model exists in the database and
     * therefore should be inserted or updated
     *
     * @var bool
     */
    private $exists = false;

    /**
     * Constructs new model based on attributes
     *
     * @param array $attributes (optional)
     * @param bool $exists (optional)
     * @return self
     */
    public function __construct(array $attributes = null, bool $exists = false)
    {
        $this->exists = $exists;

        foreach ($this->attributes as $attribute) {
            if ($attributes && array_key_exists($attribute, $attributes)) {
                $this->{$attribute} = $attributes[$attribute];
            } else {
                $this->{$attribute} = null;
            }
        }
    }

    /**
     * Get an array of All Models
     *
     * @return array
     */
    public static function all()
    {
        $db = Application::getInstance()->databaseConnection()->pdo();

        $stmt = $db->query('SELECT * FROM ' . static::$table);

        $result = [];
        $currentClass = get_called_class();

        while ($row = $stmt->fetch()) {
            $result[] = new $currentClass($row, true);
        }

        return $result;
    }

    /**
     * Save current Instance to the Database
     *
     * @return bool success
     */
    public function save()
    {
        if ($this->exists) {
            // Update
            $this->updateDatabase();
        } else {
            // Insert New
            $this->insertInDatabase();
        }
    }

    /**
     * Inserts the model into the database
     *
     * @return void
     */
    private function insertInDatabase()
    {
        $this->created_at = date("Y-m-d H:i:s");
        $this->updated_at = date("Y-m-d H:i:s");

        $db = Application::getInstance()->databaseConnection()->pdo();

        $attributes = implode(', ', $this->attributes);
        $values = '';
        $executeValues = [];

        foreach ($this->attributes as $attribute) {
            if ($values != '') {
                $values .= ', ';
            }

            $values .= '?';
            $executeValues[] = $this->{$attribute};
        }

        $stmt = $db->prepare('INSERT INTO ' . static::$table . '(' . $attributes . ') VALUES (' . $values . ')');
        $stmt->execute($executeValues);
    }

    /**
     * Update current object in database
     *
     * @return void
     */
    private function updateDatabase()
    {
        $this->updated_at = date("Y-m-d H:i:s");

        $db = Application::getInstance()->databaseConnection()->pdo();

        $attributes = '';
        $values = [];

        foreach ($this->attributes as $attribute) {
            if ($attributes != '') {
                $attributes .= ', ';
            }

            $attributes .= $attribute . '=?';
            $values[] = $this->{$attribute};
        }

        $stmt = $db->prepare('UPDATE ' . static::$table . ' SET ' . $attributes . ' WHERE ' . $this->idColumn . ' = ' . $this->{$this->idColumn});
        $stmt->execute($values);
    }

    /**
     * Delete current model from Database
     *
     * @return void
     */
    public function delete()
    {
        $db = Application::getInstance()->databaseConnection()->pdo();

        $stmt = $db->prepare('DELETE FROM ' . static::$table . ' WHERE ' . $this->idColumn . ' = ' . $this->{$this->idColumn});
        $stmt->execute();
    }
}
