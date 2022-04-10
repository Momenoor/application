<?php

namespace App\Services;

use Closure;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission as ModelsPermission;
use Spatie\Permission\Models\Role as ModelsRole;

class Permission
{
    protected static $abilities = [
        'view',
        'edit',
        'create',
        'delete',
    ];

    public static function resolve($permissions)
    {

        return $permissions->mapToGroups(function ($item) {
            $key = self::getKeyName($item, true);
            return [$key => $item];
        });
    }

    public function setName($value): string
    {
        return Str::slug($value);
    }

    public static function getKeyName(ModelsPermission $item, $shouldReplacement = false, $format = true): string
    {
        $replacement = ['-', '_', '*', '=', '+', '/', '\\', '|'];
        $key = Str::replace(self::$abilities, '', $item->name);
        if ($shouldReplacement) {
            $key = Str::replace($replacement, '', $key);
        }
        $key = trim($key);
        $key = self::checkFomat($key, $format);
        return $key;
    }

    public static function getValueName(ModelsPermission $item, $format = false): string
    {
        $key = self::getKeyName($item, false, false);
        $value = Str::replace($key, '', $item->name);
        $value = self::checkFomat($value, $format);
        return $value;
    }

    protected static function checkFomat($value, $format)
    {
        if ($format) {
            if ($format instanceof Closure) {
                $value = $format($value);
            } elseif (method_exists(Str::class, $format)) {
                $value = Str::$format($value);
            } else {
                $value = Str::ucfirst($value);
            }
        }
        return $value;
    }

    public static function getRoles()
    {
        $roles = ModelsRole::withCount('users')->with('permissions')->paginate(5);
        $roles->mapToGroups(function ($item) {
            return $item['permissions'] = static::resolve($item->permissions);
        });

        return $roles;
    }
}
