<?php

namespace Aaran\Frappe\Models;

use Aaran\Frappe\Database\Factories\StockBalanceFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockBalance extends Model
{
    use HasFactory;

    protected $table = 'stock_balances';
    protected $guarded = [];

//    public static function search(string $searches)
//    {
//        $query = static::query();
//
//        $fieldMap = [
//            'ic' => 'item_code',
//            'ig' => 'item_group',
//            'br'  => 'brand',
//            'item' => 'item_name',
//            // Add more shortcodes as needed
//        ];
//
//        $tokens = preg_split('/\s+/', trim($searches));
//
//        foreach ($tokens as $token) {
//            if (str_contains($token, ':')) {
//                [$field, $value] = explode(':', $token, 2);
//
//                // Map shortcode to actual column
//                $column = $fieldMap[$field] ?? $field;
//
//                // Check if the resolved column is valid
//                if (in_array($column, ['item_code', 'item_group', 'brand', 'item_name'])) {
//                    $query->where($column, 'like', '%' . $value . '%');
//                }
//            } else {
//                // Fallback for general keyword
//                $query->where(function ($q) use ($token) {
//                    $q->where('item_name', 'like', '%' . $token . '%')
//                        ->orWhere('item_group', 'like', '%' . $token . '%')
//                        ->orWhere('brand', 'like', '%' . $token . '%')
//                        ->orWhere('item_code', 'like', '%' . $token . '%');
//                });
//            }
//        }
//
//        return $query;
//    }


    /**
     * @param string $searches
     * @return Builder
     * ic:123 ig:mouse	item_code like 123 AND item_group like mouse
     * br:"hp pavilion"    brand like hp pavilion
     * "gaming mouse"    general keyword across all fields
     * ic:123 general    item_code like 123 AND general keyword search
     * ic:abc    item_code LIKE '%abc%'
     * ic==abc    item_code = 'abc'
     * -ig:mouse    item_group NOT LIKE '%mouse%'
     * -ic==XYZ123    item_code != 'XYZ123'
     * b:"hp laptop" OR mouse    brand LIKE 'hp laptop' OR full-text match

     *
     */
//    public static function search(string $searches)
//    {
//        $query = static::query();
//
//        $fieldMap = [
//            'ic' => 'item_code',
//            'ig' => 'item_group',
//            'br'  => 'brand',
//            'in' => 'item_name',
//        ];
//
//        // Match tokens like: ic:"value with spaces" or ic:value
//        preg_match_all('/(\w+):"([^"]+)"|(\w+):(\S+)|"([^"]+)"|(\S+)/', $searches, $matches, PREG_SET_ORDER);
//
//        foreach ($matches as $match) {
//            $field = null;
//            $value = null;
//
//            if (!empty($match[1]) && isset($match[2])) {
//                // shortcode:"value with space"
//                $field = $fieldMap[$match[1]] ?? $match[1];
//                $value = $match[2];
//            } elseif (!empty($match[3]) && isset($match[4])) {
//                // shortcode:value
//                $field = $fieldMap[$match[3]] ?? $match[3];
//                $value = $match[4];
//            } elseif (!empty($match[5])) {
//                // general "quoted value"
//                $value = $match[5];
//            } elseif (!empty($match[6])) {
//                // general keyword
//                $value = $match[6];
//            }
//
//            if ($field && in_array($field, ['item_code', 'item_group', 'brand', 'item_name'])) {
//                $query->where($field, 'like', '%' . $value . '%');
//            } elseif ($value) {
//                // fallback: keyword search in multiple fields
//                $query->where(function ($q) use ($value) {
//                    $q->where('item_name', 'like', '%' . $value . '%')
//                        ->orWhere('item_group', 'like', '%' . $value . '%')
//                        ->orWhere('brand', 'like', '%' . $value . '%')
//                        ->orWhere('item_code', 'like', '%' . $value . '%');
//                });
//            }
//        }
//
//        return $query;
//    }


    /**
     * @param string $searches
     * @return Builder
     *
     * price>500    Price greater than 500
     * -qty<=100    Balance quantity not less than or equal to 100
     * ig==mouse OR rate<5    item_group = 'mouse' OR valuation_rate < 5
     * val!=0    balance_value is not 0
     *  >    Greater than
     *  <    Less than
     *  >=    Greater or equal
     *  <=    Less or equal
     *  ==    Equals
     *  !=    Not equal
     */
    public static function search(string $searches)
    {
        $query = static::query();

        $fieldMap = [
            'ic'    => 'item_code',
            'ig'    => 'item_group',
            'b'     => 'brand',
            'in'    => 'item_name',
            'qty'   => 'balance_qty',
            'val'   => 'balance_value',
            'price' => 'valuation_rate',
        ];

        // Split by space
        $terms = preg_split('/\s+/', $searches);

        foreach ($terms as $term) {
            // Match pattern like: -key==value or key>value
            if (preg_match('/^(-)?(\w+)(:|==|!=|>=|<=|>|<)(.+)$/', $term, $matches)) {
                [, $negate, $key, $operator, $value] = $matches;

                $field = $fieldMap[$key] ?? null;
                if (!$field) continue;

                $value = trim($value, '"\''); // Remove quotes

                if ($operator === ':') {
                    $query->when(!$negate, fn($q) => $q->where($field, 'like', "%$value%"))
                        ->when($negate, fn($q) => $q->where($field, 'not like', "%$value%"));
                } else {
                    $op = $operator === '==' ? '=' : $operator;
                    $query->when(!$negate, fn($q) => $q->where($field, $op, $value))
                        ->when($negate, fn($q) => $q->where($field, 'NOT '.$op, $value));
                }

            } elseif (!empty($term)) {
                // Free text search
                $query->where(function ($q) use ($term) {
                    $q->where('item_name', 'like', "%$term%")
                        ->orWhere('item_group', 'like', "%$term%")
                        ->orWhere('brand', 'like', "%$term%")
                        ->orWhere('item_code', 'like', "%$term%");
                });
            }
        }

        return $query;
    }






    protected static function newFactory(): StockBalanceFactory
    {
        return StockBalanceFactory::new();
    }
}
