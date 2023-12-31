<?php
/**
 * Created by PhpStorm.
 * User: ToXaHo
 * Date: 21.04.2017
 * Time: 19:26
 */

namespace App\Http\Controllers;

use App\Cases;
use App\Item;
use App\Live;
use App\User;
use App\Category;

class PagesController extends Controller
{

    public function index()
    {
		$category = Category::orderBy('id', 'desc')->get();
        $case = Cases::where('id', 1)->first();
        $items = [];
        foreach (json_decode($case->items) as $item) {
            $item1 = Item::where('id', $item)->first();
            for ($i = 0; $i < 10; $i++) {
                $items[] = $item1;
            }
        }
        shuffle($items);
        $cases = Cases::where('id', '>', 1)->orderBy('id', 'desc')->get();
        return view('pages.index', compact('items', 'case', 'cases', 'category'));
    }
	
	public function user($id)
	{
		$user = User::find($id);
		if (!$user) return redirect('/');
		$wins = Live::where('user_id', $user->id)->orderBy('id', 'desc')->get();
        foreach ($wins as $win) {
            $win->item = Item::where('id', $win->item_id)->first();
        }
		return view('pages.user', compact('user', 'wins'));
	}

    public function cases($id)
    {
        $case = Cases::where('id', $id)->first();
        if (is_null($case)) return redirect('/');
        $items = [];
        $demoItems = [];
        foreach (json_decode($case->items) as $item) {
            $item1 = Item::where('id', $item)->first();
            for ($i = 0; $i < 10; $i++) {
                $items[] = $item1;
            }
            $demoItems[] = $item1;
        }
        usort($demoItems, function($a, $b){
            return ($b['sell_price'] - $a['sell_price']);
        });
        return view('pages.case', compact('case', 'demoItems', 'items'));
    }

    public function price()
    {
        $case = Cases::where('id', 1)->first();
        $items = [];
        foreach (json_decode($case->items) as $item) {
            $item1 = Item::where('id', $item)->first();
            $items[] = $item1;
        }
        usort($items, function($a, $b){
            return ($b['sell_price'] - $a['sell_price']);
        });
        return view('pages.price', compact('items'));
    }

    public function oplata()
    {
        return view('pages.oplata');
    }

    public function account()
    {
        $count_ref = User::where('affiliate_use', $this->user->affiliate_code)->count();
        $wins = Live::where('user_id', $this->user->id)->orderBy('id', 'desc')->get();
        foreach ($wins as $win) {
            $win->item = Item::where('id', $win->item_id)->first();
        }
        return view('pages.account', compact('count_ref', 'wins'));
    }

    public function get($id)
    {
        $live = Live::where('id', $id)->where('user_id', $this->user->id)->first();
        if (is_null($live)) return redirect('/');
        if ($live->vi==0){
          Live::where('id', $id)->where('user_id', $this->user->id)->first()->update([
              'vi' => 1
          ]);
        }
        $live->item = Item::where('id', $live->item_id)->first();
        return view('pages.get', compact('live'));
    }
    
    public function sell($id)
    {
        $status="";
        $live = Live::where('id', $id)->where('user_id', $this->user->id)->first();
        if (is_null($live)){
          $status="Предмета не существует, попробуйте ещё раз";
        } else {
          if ($live->vi==0){
            $itemp = Item::where('id', $live->item_id)->first();
            Live::where('id', $id)->where('user_id', $this->user->id)->first()->delete();
            $balanceTo = $this->user->balance + ($itemp->sell_price/100*30);
            $this->user->update([
                'open_box' => $this->user->open_box - 1,
                'balance' => $balanceTo
            ]);
            $status="Предмет успешно продан, вам возвращены 30% его цены.";
          } else {
            $status="Вы уже получили предмет, его нельзя продать!";
          }
        }
        return view('pages.sell', compact('status'));
    }

    public function craft()
    {
        $wins = Live::where('user_id', $this->user->id)->orderBy('id', 'desc')->get();
        foreach ($wins as $win) {
            $win->item = Item::where('id', $win->item_id)->first();
        }
        return view('pages.craft', compact('wins'));
    }

    public function feedback()
    {
        return view('pages.feedback');
    }

    public function faq()
    {
        return view('pages.faq');
    }
    public function garant()
    {
        return view('pages.garant');
    }

}