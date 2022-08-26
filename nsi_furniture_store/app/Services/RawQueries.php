<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class RawQueries
 * @package App\Services
 */
class RawQueries
{
    public function get_with_raw_query($type)
    {
        switch($type)
        {
            case 'furniture':
                $results = DB::select( DB::raw("SELECT 
                                                    f.id as main_id,
                                                    f.name as f_name,
                                                    f.description,
                                                    f.price,
                                                    c.title,
                                                    c.content,
                                                    c.created_at,
                                                    u.name as u_name,
                                                    (
                                                        SELECT 
                                                            GROUP_CONCAT( DISTINCT c.name)
                                                        FROM
                                                            categories as c
                                                        INNER JOIN category_furniture as c_f ON c.id = c_f.category_id
                                                        INNER JOIN furniture as f ON c_f.furniture_id = f.id
                                                        WHERE c_f.id = main_id
                                                    ) as furniture_categories
                                                FROM 
                                                    furniture as f
                                                LEFT JOIN comments as c ON f.id = c.furniture_id
                                                LEFT JOIN users as u ON c.user_id = u.id;"));
                break;

            case 'orders':
                $results = DB::select( DB::raw("SELECT 
                                                    o.name as o_name,
                                                    u.name as u_name,
                                                    o.created_at,
                                                    f.name as f_name,
                                                    f.price,
                                                    f_o.quantity,
                                                    f.price * f_o.quantity AS total
                                                FROM 
                                                    orders as o
                                                INNER JOIN users as u ON o.user_id = u.id
                                                INNER JOIN furniture_order as f_o ON o.id = f_o.order_id
                                                INNER JOIN furniture as f ON f_o.furniture_id = f.id
                                                WHERE
                                                    u.id = 1
                                                ORDER BY
                                                    o.created_at"));
                break;

            case 'users':
                $results = DB::select( DB::raw("SELECT 
                                                    u.name as u_name,
                                                    u.email,
                                                    CONCAT(a.name, ' ',  a.number) as address
                                                FROM 
                                                    users as u
                                                INNER JOIN addresses as a ON u.id = a.user_id"));
                break;

            case 'categories':
                $results = DB::select( DB::raw("SELECT 
                                                    c.name as c_name,
                                                    f.name as f_name
                                                FROM 
                                                    categories as c
                                                INNER JOIN category_furniture as c_f ON c.id = c_f.category_id
                                                INNER JOIN furniture as f ON c_f.furniture_id = f.id;"));
                break;

            default:
                echo 'Invalid type!';
        }
        

        return $results;
    }
}