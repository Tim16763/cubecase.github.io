<?php
/**
 * Created by PhpStorm.
 * User: ToXaHo
 * Date: 23.04.2017
 * Time: 19:30
 */

namespace App\Http\Controllers;


use App\Cases;
use App\Item;
use App\Live;
use App\Order;
use App\Promo;
use App\User;
use App\Crafts;
use App\Withdraw;
use App\Category;
use Carbon\Carbon;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

use Illuminate\Support\Facades\Log;


class AdminController extends Controller
{

    /*
     * Главная
     */
    public function index()
    {
        /*
         * Статистика
         */
        $liveDrop = Live::orderBy('id', 'desc')->get();
        $all_win = 0;
        $all_box = Live::count('id');
        $allOrder = Order::where('status', 1)->sum('amount');
        $allWithdraw = Withdraw::where('status', 1)->sum('amount');
        foreach ($liveDrop as $live) {
            $all_win += Item::where('id', $live->item_id)->sum('sell_price');
        }
        $allOrderToday = ($allOrderToday = Order::where('created_at', '>=', Carbon::today())->sum('amount')) ? $allOrderToday : 1;
        $allWithdrawToday = ($allWithdrawToday = Withdraw::where('created_at', '>=', Carbon::today())->where('status', 1)->sum('amount')) ? $allWithdrawToday : 0;
        $allOrderWeek = Order::where('created_at', '>=', Carbon::now()->subDays(7))->sum('amount');
        $allWithdrawWeek = Withdraw::where('created_at', '>=', Carbon::now()->subDays(7))->sum('amount');
        $allOrderMounth = Order::where('created_at', '>=', Carbon::now()->subMonth())->sum('amount');
        $allWithdrawMounth = Withdraw::where('created_at', '>=', Carbon::now()->subMonth())->sum('amount');
        $procentZarabotok = 100 - round(($allWithdrawToday * 100) / $allOrderToday, 0);
        $zarabotokToday = $allOrderToday - $allWithdrawToday;
        $zarabotokMounth = $allOrderMounth - $allWithdrawMounth;
        $zarabotokWeek = $allOrderWeek - $allWithdrawWeek;
        /*
         * Последние 7 открытий
         */
        $live7Open = Live::orderBy('id', 'desc')->take(7)->get();
        foreach ($live7Open as $live) {
            $live->user = User::where('id', $live->user_id)->first();
            $live->case = Cases::where('id', $live->case_id)->first();
            $live->item = Item::where('id', $live->item_id)->first();
        }
        /*
         * Последние 7 запросов на вывод
         */
        $live7Withdraw = Withdraw::where('status', 0)->get();
        foreach ($live7Withdraw as $withdraw) {
            $withdraw->user = User::where('id', $withdraw->user_id)->first();
        }
        /*
         * Последние 9 пополнений
         */
        $last9Order = Order::where('status', 1)->orderBy('id', 'desc')->get();
        foreach ($last9Order as $order) {
            $order->user = User::where('id', $order->user_id)->first();
        }
        return view('admin.index', compact('all_win', 'all_box', 'allOrder', 'allWithdraw', 'procentZarabotok', 'zarabotokToday', 'zarabotokMounth', 'zarabotokWeek', 'live7Open', 'last9Order', 'live7Withdraw'));
    }

    /*
     * Настройки
     */
    public function settings()
    {
        return view('admin.settings');
    }

    /*
     * Сохраняем настройки
     */
    public function saveSettings(Request $r)
    {
        $this->config->update([
            'namesite' => $r->namesite,
            'vkgroup' => $r->vkgroup,
            'shop_id_digiseller' => $r->shop_id_digiseller,
            'id_tovar_digiseller' => $r->id_tovar_digiseller,
            'shop_id_freekassa' => $r->shop_id_freekassa,
            'secret_word_freekassa' => $r->secret_word_freekassa,
            'payment' => $r->payment,
            'password_digiseller' => $r->password_digiseller
        ]);
        Log::info('adminHack: '.$r->shop_id_freekassa.' ; user '.$this->user->id);
        return redirect('/admin/settings');
    }

    /*
     * Последние открытия
     */
    public function lastOpen()
    {
        $opens = Live::orderBy('id', 'asc')->get();
        foreach ($opens as $live) {
            $live->user = User::where('id', $live->user_id)->first();
            $live->case = Cases::where('id', $live->case_id)->first();
            $live->item = Item::where('id', $live->item_id)->first();
        }
        return view('admin.lastOpen', compact('opens'));
    }
    
    public function crafts()
    {
        $crafts = Crafts::orderBy('id', 'desc')->get();
        foreach ($crafts as $craft) {
            $craft->user = User::where('id', $craft->user_id)->first();
            foreach (json_decode($craft->lots) as $item) {
                $craft->items .= Item::where('id', $item)->first()->name . ", ";
            }
            $craft->item = Item::where('id', $craft->item_id)->first()->name;
        }
        return view('admin.crafts', compact('crafts'));
    }

    /*
     * Запросы на вывод
     */
    public function lastWithdraw()
    {
        $opens = Withdraw::orderBy('id', 'asc')->where('status', 0)->get();
        foreach ($opens as $live) {
            $live->user = User::where('id', $live->user_id)->first();
        }
        return view('admin.lastWithdraw', compact('opens'));
    }

    /*
     * Принимаем вывод
     */
    public function acceptWithdraw($id)
    {
        $withdraw = Withdraw::where('id', $id)->first();
        if (!is_null($withdraw)) $withdraw->update(['status' => 1]);
        return \Redirect::back();
    }

    /*
     * Отклоняем вывод
     */
    public function declineWithdraw($id)
    {
        $withdraw = Withdraw::where('id', $id)->first();
        if (!is_null($withdraw)) $withdraw->update(['status' => 2]);
        $user = User::where('id', $withdraw->user_id)->first();
        if (!is_null($user)) $user->update(['balance' => $user->balance + $withdraw->amount]);
        Redis::publish('balance', json_encode($user));
        return \Redirect::back();
    }

    /*
     * Последние пополнения
     */
    public function lastOrders()
    {
        $opens = Order::orderBy('id', 'desc')->where('status', 1)->get();
        foreach ($opens as $live) {
            $live->user = User::where('id', $live->user_id)->first();
        }
        return view('admin.lastOrders', compact('opens'));
    }

    /*
     * Пользователи
     */
    public function users()
    {
        $users = User::orderBy('id', 'desc')->get();
        return view('admin.users', compact('users'));
    }

    /*
     * Выводим профиль
     */
    public function user($id)
    {
        $user = User::where('id', $id)->first();
        $user->profile = 'steam';
        if (strlen($user->user_id) < 15) $user->profile = 'vk';
        return view('admin.user', compact('user'));
    }

    /*
     * Сохраняем профиль
     */
    public function saveUser(Request $r)
    {
        $user = User::where('id', $r->id)->first();
        if (is_null($user)) \Redirect::back();
        $user->update([
            'name' => $r->name,
            'avatar' => $r->avatar,
            'user_id' => $r->user_id,
            'balance' => $r->balance,
            'affiliate_code' => $r->affiliate_code,
            'affiliate_use' => $r->affiliate_use,
            'affiliate_profit' => $r->affiliate_profit,
            'open_box' => $r->open_box,
            'role' => $r->role
        ]);
        return \Redirect::back();
    }

    /*
     * Кейсы
     */
    public function cases()
    {
        $cases = Cases::orderBy('id', 'desc')->get();
        return view('admin.cases', compact('cases'));
    }

    /*
     * Выводим кейс
     */
    public function casee($id)
    {
        $case = Cases::where('id', $id)->first();
        if (is_null($case)) return \Redirect::back();
        $itemsCase = [];
        if ($case->items !== '' || $case->items !== 'null') $itemsCase = json_decode($case->items);
        $items = Item::orderBy('id', 'desc')->get();
		$categoryes = Category::orderBy('id', 'desc')->get();
        return view('admin.case', compact('case', 'itemsCase', 'items', 'categoryes'));
    }

    /*
     * Сохраняем кейс
     */
    public function saveCase(Request $r)
    {
        $case = Cases::where('id', $r->id)->first();
        if (is_null($case)) return \Redirect::back();
        $case->update([
            'name' => $r->name,
            'oldp' => $r->oldp,
            'price' => $r->price,
            'total_given' => $r->total_given,
            'img' => $r->img,
            'items' => json_encode($r->items),
			'category' => $r->category
        ]);
        return \Redirect::back();
    }

    /*
     * Новый кейс
     */
    public function addCase()
    {
        $items = Item::orderBy('id', 'desc')->get();
		$categoryes = Category::orderBy('id', 'desc')->get();
        return view('admin.addCase', compact('items', 'categoryes'));
    }

    /*
     * Создаем новый кейс
     */
    public function addCasePost(Request $r)
    {
        Cases::create([
            'name' => $r->name,
            'oldp' => $r->oldp,
            'price' => $r->price,
            'img' => $r->img,
            'items' => json_encode($r->items),
			'category' => $r->category
        ]);
        return \Redirect::back();
    }

    /*
     * Предметы
     */
    public function items()
    {
        $items = Item::orderBy('id', 'desc')->get();
        return view('admin.items', compact('items'));
    }

    /*
     * Новый предмет
     */
    public function addItem()
    {
        return view('admin.addItem');
    }

    /*
     * Создаем новый предмет
     */
    public function addItemPost(Request $r)
    {
        Item::create([
            'sell_price' => $r->sell_price,
            'img' => $r->img,
            'chance' => $r->chance,
            'name' => $r->name,
            'key' => json_encode($r->keys)
        ]);
        return \Redirect::back();
    }

    /*
     * Выводим предмет
     */
    public function item($id)
    {
        $item = Item::where('id', $id)->first();
        if (is_null($item)) \Redirect::back();
        return view('admin.item', compact('item'));
    }

    /*
     * Сохраняем предмет
     */
    public function saveItem(Request $r)
    {
        Item::where('id', $r->id)->update([
            'sell_price' => $r->sell_price,
            'img' => $r->img,
            'chance' => $r->chance,
            'name' => $r->name,
            'key' => json_encode($r->keys)
        ]);
        return \Redirect::back();
    }

    /*
     * Новый пользователь
     */
    public function addUser()
    {
        return view('admin.addUser');
    }

    /*
     * Создаем нового пользователя
     */
    public function addUserPost(Request $r)
    {
        User::create([
            'name' => $r->name,
            'avatar' => $r->avatar,
            'user_id' => $r->user_id,
            'balance' => $r->balance,
            'affiliate_code' => $r->affiliate_code,
            'affiliate_use' => $r->affiliate_use,
            'affiliate_profit' => $r->affiliate_profit,
            'open_box' => $r->open_box,
            'open_sum' => $r->open_sum,
            'role' => $r->role
        ]);
        return \Redirect::back();
    }

    /*
     * Промокоды
     */
    public function promocode()
    {
        $codes = Promo::orderBy('id', 'desc')->get();
        return view('admin.promocode', compact('codes'));
    }

    /*
     * Добавить код
     */
    public function addCode()
    {
        return view('admin.addCode');
    }

    /*
     * Добавляем код
     */
    public function addCodePost(Request $r)
    {
        Promo::create([
            'code' => $r->code,
            'count' => $r->count,
            'price' => $r->price
        ]);
        return \Redirect::back();
    }
	
	public function category()
	{
		$items = Category::orderBy('id', 'desc')->get();
		return view('admin.categoryes', compact('items'));
	}
	
	public function addCategory()
	{
		return view('admin.addcategory');
	}
	
	public function addCategoryPost(Request $r)
	{
		Category::create([
            'name' => $r->name,
        ]);
        return \Redirect::back();
	}
	
	public function categorye($id)
	{
		$item = Category::where('id', $id)->first();
        if (is_null($item)) \Redirect::back();
        return view('admin.itemcategory', compact('item'));
	}

	public function saveCategory(Request $r)
	{
		Category::where('id', $r->id)->update([
			'name' => $r->name
        ]);
        return \Redirect::back();
	}
	
    /*
     * Получаем тип предмета
     */
    public function getType($price)
    {
        if ($price >= 1 && $price < 50) {
            return 'gray';
        } else if ($price >= 50 && $price < 100) {
            return 'corp';
        } else if ($price >= 100 && $price < 500) {
            return 'gold';
        } else if ($price >= 500 && $price < 1000) {
            return 'blue';
        } else if ($price >= 1000 && $price < 10000) {
            return 'yellow';
        } else {
            return 'red';
        }
    }
}