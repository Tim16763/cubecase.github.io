<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\User;
use App\Live;
use App\Cases;
use App\Item;

use Auth;
use App\Card;

class CardController extends Controller
{

	public function index($id)
	{
    $case = Cases::where('id', $id)->first();
    if (is_null($case)) return redirect('/');
    $demoItems = [];
    foreach (json_decode($case->items) as $item) {
        $demoItems[] = Item::where('id', $item)->first();
    }
    usort($demoItems, function($a, $b){
        return ($b['sell_price'] - $a['sell_price']);
    });
		return view('pages.card', compact('case', 'demoItems'));
	}
  
	private function otherItems($jsonItems, $Cells)
	{
    $other = []; $countOpen = [];
    $closedItems = [0,1,2,3,4,5,6,7,8];
    foreach ($jsonItems as $item) {
      if(in_array($item['n'], $closedItems)){
        if(isset($countOpen[$item['img']])) {
          $countOpen[$item['img']]++;
        } else {
          $countOpen[$item['img']] = 1;
        }
        unset($closedItems[array_search($item['n'], $closedItems)]);
      }
    }
    foreach ($Cells as $item) {
      $img = "/images/cards/" . $item['id'] . ".png";
      if(!isset($countOpen[$img])) $countOpen[$img] = 0;
    }
    
    for ($j=0; $j < count($countOpen); $j++) {
      $_card = current($countOpen);
      if ($_card != 3) {
        for($i=0; $i < abs($_card-3); $i++){
          $_num = array_rand($closedItems);
          $other[] = ['img' => key($countOpen), 'n' => $_num];
          unset($closedItems[$_num]);
        }
      }
      next($countOpen);
    }
    return $other;
  }
  
	private function sendItem($case_id,$item_id,$r)
	{
    $r->session()->forget('q');
    $r->session()->forget('k');
    $r->session()->forget('p');
    $r->session()->forget('g');
    $r->session()->forget('r');
    $r->session()->forget('j');

    $item = Item::where('id', $item_id)->first();
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
    $forUser = Live::create([
        'user_id' => $this->user->id,
        'item_id' => $item->id,
        'case_id' => $case_id,
        'key' => $winKey
    ]);
		return $forUser->id;
	}

	public function plus(Request $r)
	{
    $output=[];
    $case = Cases::where('id', $r->id)->first();
    if (is_null($case)) return response()->json(['message' => 'Ошибка, обновите страницу']);
    if ($case->price > $this->user->balance) {
      return response()->json(['error' => '1', 'title' => 'Отсутствует баланс у пользователя', 'message' => '<a class="login" href="/oplata/">Пополнить</a>']);
    } else {
        $this->user->update([
            'balance' => $this->user->balance - floor($case->price/100*10)
        ]);
    }
    if ($r->session()->exists('q')) {
      if (!$r->session()->get('p',false)) {
        $r->session()->put('p', true);
        $output=['success' => true];
      } else {
        $output=['message' => 'Дополнительная попытка уже была получена!'];
      }
    } else {
      $output=['message' => 'Ошибка, обновите страницу'];
    }
    return response()->json($output);
	}

	public function prize(Request $r)
	{
    $output = [];
    $case = Cases::where('id', $r->id)->first();
    if (is_null($case)) return response()->json(['message' => 'Ошибка, не существует кейса']);
    if ($r->session()->exists('q') AND $r->session()->exists('j') AND !$r->session()->get('g',false)) {
      $jsonItems = $r->session()->get('j');
      $new_array = array();
      foreach ($jsonItems as $key => $value) {
        if(isset($new_array[$value['id']]))
            $new_array[$value['id']] += 1;
        else
            $new_array[$value['id']] = 1;
      }
      foreach ($new_array as $item => $n) {
        if($n >= 3){
          $output = ['info' => 'win', 'other' => $this->otherItems($r->session()->get('j'), $r->session()->get('r')), 'id' => $this->sendItem($case->id, $item, $r) ];
          break;
        }
      }
    } else {
      $output = ['message' => 'Ошибка открытия, обновите страницу'];
    }
    return response()->json($output);
	}

	public function open(Request $r)
	{
    $output = [];
    $case = Cases::where('id', $r->id)->first();
    if (is_null($case)) return response()->json(['message' => 'Ошибка, обновите страницу']);

    if ($r->session()->exists('q') AND $r->num>=0 AND $r->num <=10) {
      $nK = (int)$r->session()->get('k',0);
      if($nK==3 AND !$r->session()->get('p',false) AND $r->num!=10){
        $output = ['info' => 'plus'];
      } elseif(
        $r->session()->get('g',false) OR
        //($nK>=3 AND !$r->session()->get('p',false)) OR
        ($nK>4 AND $r->session()->get('p',false) AND $r->num!=10)
      ){
        $output = ['message' => 'Попытки превышены '];
      } elseif($nK<3 OR ($r->num==10 AND !$r->session()->get('g',false)) OR ($nK==3 AND $r->session()->get('p',false))) {
        $jsonItems = array();
        if ($r->session()->exists('j')){
          $jsonItems = $r->session()->get('j');
          foreach ($jsonItems as $item) {
            if($r->num==$item['n']){
              return response()->json(['message' => 'Ячейка уже открыта']);
            }
          }
        }
        
        $r->session()->put('k', $nK+1);
        $item = Item::where('id', $r->session()->get('f')[$nK])->first();
        if($r->num==10){
          $r->session()->put('g', true);
          $item = Item::where('id', $r->session()->get('f')[4])->first();
          $output = ['info' => 'win', 'other' => $this->otherItems($r->session()->get('j'), $r->session()->get('r')), "item" => $this->sendItem($case->id, $item->id, $r)];
        }
        $output = array_merge($output, [
          'img' => "/images/cards/" . $item->id . ".png",
          'name' => $item->name,
          'id' => $item->id,
          'n' => $r->num
        ]);
        array_push($jsonItems, $output);
        $r->session()->put('j', $jsonItems);
      }
    } else {
      $output = ['message' => 'Ошибка открытия, обновите страницу'];
    }
    return response()->json($output);
	}

	public function start(Request $r)
	{
    $case = Cases::where('id', $r->id)->first();
    if (is_null($case)) return response()->json(['message' => 'Ошибка, обновите страницу']);
    if ($case->price > $this->user->balance) {
      return response()->json(['error' => '1', 'title' => 'Отсутствует баланс у пользователя', 'message' => '<a class="login" href="/oplata/">Пополнить</a>']);
    } else {
        $this->user->update([
            'open_box' => $this->user->open_box + 1,
            'balance' => $this->user->balance - $case->price
        ]);
    }
    $r->session()->put('q', true);//куплено
    $r->session()->put('k', 0);//обнуление открытых ячеек
    $r->session()->put('p', false);//доп попытка
    $r->session()->put('g', false);//открытие гаранта
    $r->session()->forget('r');//array Cells
    $r->session()->forget('j');//array Future
    
    /* Генерация выпадания карточек */
    $items = [];
    foreach (json_decode($case->items) as $item) {
        $itm = Item::where('id', $item)->first();
        $items[] = ['id'=> $itm['id'], 'sell_price' => $itm['sell_price'], 'chance' => $itm['chance']];
    }
    usort($items, function($a, $b){
        return ($b['sell_price'] - $a['sell_price']);
    });
    $ItemsCount = count($items);
    $ItemsMid = floor($ItemsCount/2);
    $Future = [];
    $Cells = [];

    $Cells[] = $items[mt_rand(0, $ItemsMid)];//самый дорогой [0]

    if ($ItemsCount == 1){
      $Cells[] = $items[1];
      $Cells[] = $items[1];
    } elseif($ItemsCount == 2) {
      $Cells[] = $items[1];
      if ($items[2]['chance'] > 0){
        $Cells[] = $items[2];
      } else {
        $Cells[] = $items[1];
      }      
    } else {
      $randItem = 0; $isEx = true;
      while($isEx){
        if ($randItem = mt_rand(0, $ItemsCount-1) AND $items[$randItem]['chance'] > 0){
          $isEx = false;
        }
      }

      if ($newRand = mt_rand($ItemsMid, $ItemsCount-1) AND $randItem == $newRand){
        if ($newRand+1 !== $ItemsCount){
          $Cells[] = $items[$newRand+1];
        } else {
          $Cells[] = $items[$newRand-1];
        }
      } else {
        $Cells[] = $items[mt_rand($ItemsMid, $ItemsCount-1)];
      }
      $Cells[] = $items[$randItem];
    }
    $r->session()->put('r', $Cells);

    for ($i=0; $i<5; $i++){
      if ($i == 1 AND mt_rand(0,1)){
        //для второй карточки вероятность 50% совпасть с первой
        $Future[] = $Future[0];
        continue;
      }
      
      if ($this->user->role == 'youtuber') {
        //ютуберам высокая вероятность дорогих карточек
        if ($i > 3){
          $Future[] = $Cells[mt_rand(0,1)]['id'];
          continue;
        }
        if (mt_rand(0,99) < 80){
          $Future[] = $Cells[mt_rand(0,1)]['id'];
        } else {
          $Future[] = $Cells[mt_rand(1,2)]['id'];
        }
      } else {
        if ($i > 1){//гарантированный кейс - дешёвый
          for($j=0; $j < 3; $j++){
            if ($Cells[$j]['chance'] == 100){
              $Future[] = $Cells[$j]['id'];
              continue 2;
            }
          }
          $Future[] = $Cells[2]['id'];
          continue;
        }
        
        //дорогая вещь отностительно средней цены вещей, шанс 2 к 7 = 28%
        if (in_array(mt_rand(0,13), array(2,5,7,11))){
          $Future[] = $Cells[0]['id'];
        } else {
          $Future[] = $Cells[1]['id'];
        }
      }
    }
    $r->session()->put('f', $Future);

    return response()->json([
        'success' => true
    ]);
	}

}