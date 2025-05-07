<?php

namespace Aaran\Frappe\Models;

use Aaran\Frappe\Database\Factories\InventoryFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function search(string $searches)
    {
        $query = static::query();

        $fieldMap = [
            'ic' => 'item_code',
            'ig' => 'item_group',
            'br'  => 'brand',
            'item' => 'item_name',
            // Add more shortcodes as needed
        ];

        $tokens = preg_split('/\s+/', trim($searches));

        foreach ($tokens as $token) {
            if (str_contains($token, ':')) {
                [$field, $value] = explode(':', $token, 2);

                // Map shortcode to actual column
                $column = $fieldMap[$field] ?? $field;

                // Check if the resolved column is valid
                if (in_array($column, ['item_code', 'item_group', 'brand', 'item_name'])) {
                    $query->where($column, 'like', '%' . $value . '%');
                }
            } else {
                // Fallback for general keyword
                $query->where(function ($q) use ($token) {
                    $q->where('item_name', 'like', '%' . $token . '%')
                        ->orWhere('item_group', 'like', '%' . $token . '%')
                        ->orWhere('brand', 'like', '%' . $token . '%')
                        ->orWhere('item_code', 'like', '%' . $token . '%');
                });
            }
        }

        return $query;
    }



    protected static function newFactory(): InventoryFactory
    {
        return InventoryFactory::new();
    }
}
