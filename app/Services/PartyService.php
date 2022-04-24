<?php

namespace App\Services;

use App\Models\Party;
use PDO;

class PartyService
{

    protected static $party;

    public static function searchBeforeAddToDatabase($data)
    {
        $name = data_get($data, 'name');
        if (!is_null($name)) {
            $party = Party::where('name', $name)->first();
            if ($party) {
                self::$party = $party;
                return true;
            }
            return false;
        }
        return false;
    }

    public static function findOrCreate($data)
    {
        $isFound = self::searchBeforeAddToDatabase($data);
        if ($isFound) {
            return self::$party;
        }
        return self::$party = Party::create($data);
    }
}
