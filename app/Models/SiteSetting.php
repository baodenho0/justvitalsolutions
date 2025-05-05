<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'group',
        'type',
    ];

    /**
     * Get a setting value by key.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function getValue(string $key, $default = null)
    {
        $setting = self::where('key', $key)->first();

        if (!$setting) {
            return $default;
        }

        // Handle different types of settings
        switch ($setting->type) {
            case 'boolean':
                return (bool) $setting->value;
            case 'number':
                return (float) $setting->value;
            case 'array':
            case 'json':
                return ($setting->value);
            default:
                return $setting->value;
        }
    }

    /**
     * Set a setting value by key.
     *
     * @param string $key
     * @param mixed $value
     * @param string $group
     * @param string $type
     * @return SiteSetting
     */
    public static function setValue(string $key, $value, string $group = 'general', string $type = 'text')
    {
        // Prepare the value based on type
        if (is_array($value) || is_object($value)) {
            $value = json_encode($value);
            $type = 'json';
        } elseif (is_bool($value)) {
            $value = $value ? '1' : '0';
            $type = 'boolean';
        }

        return self::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'group' => $group,
                'type' => $type,
            ]
        );
    }

    /**
     * Scope a query to filter by group.
     */
    public function scopeGroup($query, $group)
    {
        return $query->where('group', $group);
    }
}
