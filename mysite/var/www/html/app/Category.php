<?php
/**
 * Created by PhpStorm.
 * User: ToXaHo
 * Date: 23.04.2017
 * Time: 18:23
 */
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Item;

class Category extends Model
{
    protected $table = 'categorys';

    protected $fillable = [
        'name'
    ];
	
	protected function getCases($id)
	{
		return Cases::where('category', $id)->orderBy('id', 'desc')->get();
	}
}
