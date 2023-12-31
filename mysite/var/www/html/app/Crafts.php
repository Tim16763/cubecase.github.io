<?php
/**
 * Created by PhpStorm.
 * User: ToXaHo
 * Date: 23.04.2017
 * Time: 11:03
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class Crafts extends Model
{
    protected $table = 'crafts';

    protected $fillable = [
        'user_id', 'item_id', 'lots'
    ];
}
