<?php

namespace App\Models;

use \Core\Model;

class TreeEntry extends Model
{

    public static function getAll()
    {

        $db = static::getDB();

        $sql = "
            SELECT
                te.entry_id ,
                te.parent_entry_id ,
                tel.lang,
                tel.name
            FROM
                tree_entry te
            JOIN tree_entry_lang tel 
                ON
                te.entry_id = tel.entry_id
            WHERE
                tel.lang = 'ger'
                OR (tel.lang = 'eng'
                    AND NOT EXISTS 
                    (
                    SELECT
                        1
                    FROM
                        tree_entry_lang tel2
                    WHERE
                        tel.entry_id = tel2.entry_id
                        AND tel2.lang = 'ger'))
        ";

        $result = $db->fetchAllAssociative($sql);

        return $result;
    }
}