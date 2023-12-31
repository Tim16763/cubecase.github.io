<?php
/**
 * Created by PhpStorm.
 * User: ToXaHo
 * Date: 22.04.2017
 * Time: 16:35
 */

namespace App\Http\Controllers;

use App\Cases;
use App\Item;
use App\Live;
use App\Order;
use App\Promo;
use App\UsePromo;
use App\User;
use App\Withdraw;
use App\Crafts;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{
    /*
     * Получаем статистику
     */
    public function getStats()
    {
        session_start();
        clearstatcache();
        $SessionDir = session_save_path();
        $Timeout = 60 * 3;
        $users = 1;
          function getOnlineUsers(){
            $SessionDir = session_save_path();

            if ( $directory_handle = opendir( $SessionDir ) ) {
              $count = 0; 
              while ( false !== ( $file = readdir( $directory_handle ) ) ) {
                if($file != '.' && $file != '..'){
                  if(time()- fileatime($SessionDir . '/' . $file) < 3 * 60) {
                    $count++; 
                  }
                }
              }
              closedir($directory_handle); 
              return $count; 
            } else { 
              return false; 
            } 
          }
        $last = Live::orderBy('id', 'desc')->take(15)->get();
        foreach ($last as $item) {
            $item->user = User::where('id', $item->user_id)->first();
            $item->item = Item::where('id', $item->item_id)->first();
        }
        return response()->json([
            'count_wins' => Live::count(),
            'count_users' => User::count(),
            'count_users_online' => getOnlineUsers()+1,
            'wins' => view('includes.liveDrops', compact('last'))->render(),
        ]);
    }

    /*
     * Подгружаем вещи
     */
    public function reload(Request $r)
    {
        $case = Cases::where('id', $r->id)->first();
        $items = [];
        foreach (json_decode($case->items) as $item) {
            $item1 = Item::where('id', $item)->first();
            for ($i = 0; $i < 25; $i++) {
                $items[] = $item1;
            }
        }
        shuffle($items);
        $view = view('includes.roulette', compact('items'))->render();
        return $view;
    }

    public function craft(Request $r)
    {
        if (Auth::guest()) return response()->json(['error' => '!', "title" => "Пожалуйста войдите", "message" => '<div>Через ВК <a href="/auth/vkontakte">войти</a></div>']);

        foreach (json_decode($r->items) as $item_id) {
            $itmd = Live::where('user_id', $this->user->id)->where('item_id', $item_id);
            if ($itmd->count()>0){
              $itmd->first()->delete();
            } else {
              return response()->json(['error' => '!', "title" => "Несуществующие вещи", "message" => 'Обновите страницу!']);
            }
        }
        
        $case;
        $cases = Cases::where('id', '>', 1)->orderBy('price', 'asc')->get();

        $MidPrice = $cases[floor(count($cases)/2)]->price;
        $tempCase = $cases[rand(0, count($cases))];
        
        if ($tempCase->price>$MidPrice){
          $case = $cases[rand(0, count($cases))];
        } else {
          $case = $tempCase;
        }
        
        //////////копипаст
        $items = [];
        $allChance1 = 0;
        $items1 = json_decode($case->items);
        foreach ($items1 as $item1) {
            $item = Item::where('id', $item1)->first();
            $items[] = $item;
            $allChance1 += $item->chance;
        }
        $newItem = [];
        $lastChance = 0;
        $allChance = 0;
        if ($this->user->role == 'youtuber') {
            for ($i = 0; $i < count($items); $i++) {
                if ($items[$i]->sell_price >= $case->price) {
                    $items[$i]->chance = $items[$i]->chance + 50;
                } else {
                    $items[$i]->chance = $items[$i]->chance - 50;
                }
                $allChance += $items[$i]->chance;
            }
        } else {
            for ($i = 0; $i < count($items); $i++) {
                if ($items[$i]->sell_price <= $case->price) {
                    $items[$i]->chance = $items[$i]->chance + 50;
                }
                $allChance += $items[$i]->chance;
            }
        }
        if ($allChance == 0) $allChance = $allChance1;
        $chance = mt_rand(0, $allChance);
        for ($i = 0; $i < count($items); $i++) {
            if ($i == 0) {
                if ($chance <= $items[$i]->chance) {
                    $newItem[] = $items[$i];
                }
                $lastChance = $items[$i]->chance;
            } else {
                if (($chance > $lastChance) && ($chance <= ($lastChance + $items[$i]->chance))) {
                    $newItem[] = $items[$i];
                }
                $lastChance = $lastChance + $items[$i]->chance;
            }
        }
        if ($newItem == []) {
            $rand = array_rand($items);
            $item = $items[$rand];
        } else {
            $rand_element = rand(0, count($newItem) - 1);
            $item = $newItem[$rand_element];
        }
        if ($item->key == '[]') return response()->json(['error' => ['item_not_found' => '1']]);
        $keys = json_decode($item->key);
        $winKey = '';
        foreach ($keys as $key => $key1) {
            $winKey = $key1;
            unset($keys[$key]);
            sort($keys);
            break;
        }
        Item::where('id', $item->id)->update([
            'key' => json_encode($keys)
        ]);
        Live::create([
            'user_id' => $this->user->id,
            'item_id' => $item->id,
            'case_id' => $case->id,
            'key' => $winKey
        ]);
        Crafts::create([
            'user_id' => $this->user->id,
            'item_id' => $item->id,
            'lots' => $r->items,
        ]);
        $live = Live::orderBy('id', 'desc')->first();
        //////конец копипаста
        
        return response()->json([
            'img' => $item->img,
            'price' => $item->sell_price,
            'order_id' => $live->id
        ]);
    }

    /*
     * Открываем кейс
     */
    public function openBox(Request $r)
    {
        $id = $r->id;
        if ($id == '') $id = 1;
        $addC = (int)$r->b;
        if ($addC == '' or $addC == null) {$addC = 0;}else{
          switch ($addC) {
            case 0:
                break;
            case 1:
                $addC=15;
                break;
            case 2:
                $addC=25;
                break;
            case 3:
                $addC=50;
                break;
          }
        }
        
        $case = Cases::where('id', $id)->first();
        if (Auth::guest()) return response()->json(['error' => '!', "title" => "Пожалуйста войдите", "message" => '<div>Через ВК <a href="/auth/vkontakte">войти</a></div>']);
        if (($case->price+$addC) > $this->user->balance) return response()->json(['error' => '1', 'title' => 'Отсутствует баланс у пользователя', 'message' => '<a class="login" href="/oplata/">Пополнить</a>']);
        $items = [];
        $allChance1 = 0;
        $items1 = json_decode($case->items);
        foreach ($items1 as $item1) {
            $item = Item::where('id', $item1)->first();
            $items[] = $item;
            $allChance1 += $item->chance;
        }
        $newItem = [];
        $lastChance = 0;
        $allChance = 0;
        if ($this->user->role == 'youtuber') {
            for ($i = 0; $i < count($items); $i++) {
                if ($items[$i]->sell_price >= $case->price) {
                    $items[$i]->chance = $items[$i]->chance + 50;
                } else {
                    $items[$i]->chance = $items[$i]->chance - 50;
                }
                $allChance += $items[$i]->chance;
            }
        } else {
            for ($i = 0; $i < count($items); $i++) {
                if ($items[$i]->sell_price <= $case->price) {
                    $items[$i]->chance = $items[$i]->chance + 50;
                }
                $allChance += $items[$i]->chance;
            }
        }
        if ($allChance == 0) $allChance = $allChance1;
        $chance = mt_rand(0, $allChance);
        for ($i = 0; $i < count($items); $i++) {
            if ($i == 0) {
                if ($chance <= $items[$i]->chance) {
                    $newItem[] = $items[$i];
                }
                $lastChance = $items[$i]->chance;
            } else {
                if (($chance > $lastChance) && ($chance <= ($lastChance + $items[$i]->chance))) {
                    $newItem[] = $items[$i];
                }
                $lastChance = $lastChance + $items[$i]->chance;
            }
        }
        if ($newItem == []) {
            $rand = array_rand($items);
            $item = $items[$rand];
        } else {
            $rand_element = rand(0, count($newItem) - 1);
            $item = $newItem[$rand_element];
        }
        if ($item->key == '[]') return response()->json(['error' => ['item_not_found' => '1']]);
        $balanceTo = $this->user->balance - $case->price - $addC;
        $this->user->update([
            'open_box' => $this->user->open_box + 1,
            'balance' => $balanceTo
        ]);/*
        $keys = json_decode($item->key);
        $winKey = '';
        foreach ($keys as $key => $key1) {
            $winKey = $key1;
            unset($keys[$key]);
            sort($keys);
            break;
        }
        Item::where('id', $item->id)->update([
            'key' => json_encode($keys)
        ]);*/
        function generateRandomString($length = 10) {
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        $winKey=generateRandomString(6);
        Live::create([
            'user_id' => $this->user->id,
            'item_id' => $item->id,
            'case_id' => $case->id,
            'key' => $winKey
        ]);
        $live = Live::orderBy('id', 'desc')->first();
        return response()->json([
            'item' => [
                'src' => $item->img,
                'name' => $item->name,
                'price' => $item->sell_price
            ],
            'order_id' => $live->id
        ]);
    }

    public function stackFake555555555()
    {
      $topItems = [69,62,82,76,71,78,65,61,64,66,70];
      $tNames = ["Алан","Александр","Алексей","Альберт","Анатолий","Андрей","Антон","Арсен","Арсений","Артем","Артемий","Артур","Богдан","Борис","Вадим","Валентин","Валерий","Василий","Виктор","Виталий","Владимир","Владислав","Всеволод","Вячеслав","Геннадий","Георгий","Герман","Глеб","Гордей","Григорий","Давид","Дамир","Даниил","Демид","Демьян","Денис","Дмитрий","Евгений","Егор","Елисей","Захар","Иван","Игнат","Игорь","Илья","Ильяс","Камиль","Карим","Кирилл","Клим","Константин","Лев","Леонид","Макар","Максим","Марат","Марк","Марсель","Матвей","Мирон","Мирослав","Михаил","Назар","Никита","Николай","Олег","Павел","Петр","Платон","Прохор","Рамиль","Ратмир","Ринат","Роберт","Родион","Роман","Ростислав","Руслан","Рустам","Савва","Савелий","Святослав","Семен","Сергей","Станислав","Степан","Тамерлан","Тимофей","Тимур","Тихон","Федор","Филипп","Шамиль","Эдуард","Эльдар","Эмиль","Эрик","Юрий","Ян","Ярослав"];
      $tFamilys = ["Федоров","Морозов","Волков","Алексеев","Лебедев","Семенов","Егоров","Павлов","Козлов","Степанов","Николаев","Орлов","Андреев","Макаров","Никитин","Захаров","Зайцев","Соловьев","Борисов","Яковлев","Григорьев","Романов","Воробьев","Сергеев","Кузьмин","Фролов","Александров","Дмитриев","Королев","Гусев","Киселев","Ильин","Максимов","Поляков","Сорокин","Виноградов","Ковалев","Белов","Медведев","Антонов","Тарасов","Жуков","Баранов","Филиппов","Комаров","Давыдов","Беляев","Герасимов","Богданов","Осипов","Сидоров","Матвеев","Титов","Марков","Миронов","Крылов","Куликов","Карпов","Власов","Мельников","Денисов","Гаврилов","Тихонов","Казаков","Афанасьев","Данилов","Савельев","Тимофеев","Фомин","Чернов","Абрамов","Мартынов","Ефимов","Федотов","Щербаков","Назаров","Калинин","Исаев","Чернышев","Быков","Маслов","Родионов","Коновалов","Лазарев","Воронин","Климов","Филатов","Пономарев","Голубев","Кудрявцев"];
      $genName = $tFamilys[array_rand($tFamilys)]." ".$tNames[array_rand($tNames)];
      $u = User::where('name', $genName)->first();
      if (!$u){
          $u = User::create([
              'user_id' => 0,
              'name' => $genName,
              'avatar' => "https://vk.com/images/deactivated_hid_200.png",
              'h' => 1,
              'affiliate_code' => '0',
              'affiliate_use' => '0'
          ]);
      }
      Live::create([
          'user_id' => $u->id,
          'item_id' => $topItems[array_rand($topItems)],
          'case_id' => 1,
          'key' => '0'
      ]);
      return response()->json(['ok' => true]);
    }
    

    public function sellItem(Request $r)
    {
        if (Auth::guest()) return response()->json(['error' => '!', "title" => "Пожалуйста войдите", "message" => '<div>Через ВК <a href="/auth/vkontakte">войти</a></div>']);
        $status=""; $id = $r->id;
        $live = Live::where('id', $id)->where('user_id', $this->user->id)->first();
        if (is_null($live)){
          $status="Предмета не существует, попробуйте ещё раз";
        } else {
          if ($live->vi==0){
            $itemp = Item::where('id', $live->item_id)->first();
            Live::where('id', $id)->where('user_id', $this->user->id)->first()->delete();
            $balanceTo = $this->user->balance + ($itemp->sell_price/100*30);
            $this->user->update([
                'balance' => $balanceTo
            ]);
            $status="Предмет успешно продан, вам возвращены 30% его цены.";
          } else {
            $status="Вы уже получили предмет, его нельзя продать!";
          }
        }
        return response()->json(["info"=>$status]);
    }
    
    public function promocodeUse(Request $r)
    {
        $code = Promo::where('code', $r->code)->first();
        if (is_null($code)) return response()->json(['message' => 'Код не найден!']);
        $use = UsePromo::where('user_id', $this->user->id)->where('code_id', $code->id)->first();
        if (!is_null($use)) return response()->json(['message' => 'Вы уже активировали этот код!']);
        if ($code->count <= 0) return response()->json(['message' => 'Данный код закончился :(']);
        UsePromo::create([
            'user_id' => $this->user->id,
            'code_id' => $code->id
        ]);
        Promo::where('id', $code->id)->update([
            'count' => $code->count - 1
        ]);
        $this->user->update([
            'balance' => $this->user->balance + $code->price
        ]);
        return response()->json(['message' => 'Код успешно активирован! ' . $code->price . ' р. зачислены на ваш баланс!']);
    }

    public function profile(Request $r)
    {
        if (Auth::guest()) return;
        $user = User::where('id', $this->user->id)->first();
        if (is_null($user)) return;
        $isHidden = 0;
        if ($r->h=="false"){$isHidden=1;}
        $user->update(['h' => $isHidden]);
    }
    
    public function createPayment(Request $r)
    {
        $amount = $r->sum;
        $payway = $r->type_curr;
        // Данные магазинов
        $payment = $this->config->payment;
        $shop_id_freekassa = $this->config->shop_id_freekassa;
        $secret_word_freekassa = $this->config->secret_word_freekassa;
        $order = Order::create([
            'user_id' => $this->user->id,
            'amount' => $amount
        ]);
        if ($payment == 'freekassa') {
            $sign = md5($shop_id_freekassa . ':' . $amount . ':' . $secret_word_freekassa . ':' . $order->id);
            $pay_way = 0;
            if ($payway == 'WMR_merchant') $pay_way = 116;
            if ($payway == 'QSR') $pay_way = 63;
            if ($payway == 'PCR') $pay_way = 45;
            if ($payway == 'steampay') $pay_way = 154;
            if ($payway == 'PLR') $pay_way = 70;
            if ($payway == 'RCC') $pay_way = 94;
            if ($payway == 'BNK') $pay_way = 79;
            if ($payway == 'MTS') $pay_way = 84;
            if ($payway == 'BLN') $pay_way = 83;
            if ($payway == 'Megafon') $pay_way = 82;
            if ($payway == 'Tele2') $pay_way = 132;
            if ($payway == 'DFR') $pay_way = 0;
            return redirect('http://www.free-kassa.ru/merchant/cash.php?m=' . $shop_id_freekassa . '&oa=' . $amount . '&o=' . $order->id . '&s=' . $sign. '&i=0');
        } else {
            return redirect('https://www.oplata.info/asp2/pay_options.asp?id_d=' . $this->config->id_tovar_digiseller . '&curr=' . $payway . '&Unit_Cnt=' . $amount . '&lang=ru-RU&failpage=http://' . $this->config->namesite . '&id_order=' . $order->id);
        }
    }

    /*
     * Принимаем платежку digiseller
     */
    public function digiseller(Request $r)
    {
        $code = $r->uniquecode;
        $order_id = $r->id_order;
        $sign = md5($this->config->shop_id_digiseller . ':' . $code . ':' . $this->config->password_digiseller);
        $data = array("id_seller" => $this->config->shop_id_digiseller, "unique_code" => $code, "sign" => $sign);
        $json_data = json_encode($data);
        $url = curl_init("https://www.oplata.info/xml/check_unique_code.asp");
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($json_data),
                'X-Requested-With: XMLHttpRequest',
                'Accept: application/json, text/javascript, */*; q=0.01')
        );
        $result = curl_exec($url);
        curl_close($url);
        $result = json_decode($result);
        if ($result->retval != 0) return redirect('/');
        if ($result->unique_code !== $code) return redirect('/');
        $order = Order::where('id', $order_id)->first();
        if (is_null($order)) return redirect('/');
        if ($order->status != 0) return redirect('/');
        $user = User::where('id', $order->user_id)->first();
        if (is_null($user)) return redirect('/');
        $user->update([
            'balance' => $user->balance + $result->amount
        ]);
        $order->update([
            'status' => 1,
            'amount' => $result->amount
        ]);
        return redirect('/');
    }

    /*
     * Принимаем платежку freekassa
     */
    public function sauldebil(Request $r)
    {
        /*if (!in_array($this->getIP(), array('136.243.38.147', '136.243.38.149', '136.243.38.150', '136.243.38.151', '136.243.38.189', '88.198.88.98'))) {
            die("hacking attempt!");
        }*/
        Log::info('[pay]ok');
        $secret_word_freekassa = $this->config->secret_word_freekassa;
        $sign = md5($r->MERCHANT_ID . ':' . $r->AMOUNT . ':' . $secret_word_freekassa . ':' . $r->MERCHANT_ORDER_ID);
        $order = Order::where('id', $r->MERCHANT_ORDER_ID)->where('status', 0)->first();
        if (is_null($order)) {
Log::info('[pay]Order not found');
            die('Order not found');
        }
        $user = User::where('id', $order->user_id)->first();
        if (is_null($user)) die('User not found');
Log::info('[pay]User FOUND');
        $user->update([
            'balance' => $user->balance + $order->amount
        ]);
        $order->update([
            'status' => 1
        ]);
Log::info('[pay]GOOD');
        if (is_null($user->affiliate_use)) die('Code not found, order accept!');
        $refer = User::where('affiliate_code', $user->affiliate_use)->first();
        if (is_null($refer)) die('Refer not found');
        $money = ($order->amount * 5) / 100;
        $refer->update([
            'balance' => $refer->balance + $money,
            'affiliate_profit' => $refer->affiliate_profit + $money
        ]);
        die('Accept order, accept code');
    }

    /*
     * Проверяем IP
     */
    function getIP()
    {
        if (isset($_SERVER['HTTP_X_REAL_IP'])) return $_SERVER['HTTP_X_REAL_IP'];
        return $_SERVER['REMOTE_ADDR'];
    }

}