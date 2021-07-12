<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

use User;
use App\Models\Order;
use DB;

class OrderController extends BaseController
{

    public function index()
    {
        $user = User::find(session('user_id'));
        if(isset($user))
        {
            return view('orders')->with("user", $user);
        }
        else
        {
            return redirect('login');
        }
    }

    public function checkType($type, $query = null)
    {
        switch($type)
        {
            case 'all': return $this->ShowAllOrders($query);
            case 'delivered': return $this->ShowDelivered($query);
            case 'delivering': return $this->ShowDelivering($query);
            default: break;
        }
    }

    public function ShowAllOrders($query)
    {
        $user = User::find(session('user_id'));
        $orders = $user->orders()->get();
        return $orders;
    }

    public function ShowDelivered($query)
    {
        $user = User::find(session('user_id'));
        $orders = $user->orders()->where('stato', 'Consegnato')->get();
        return $orders;
    }

    public function ShowDelivering($query)
    {
        $user = User::find(session('user_id'));
        $orders = $user->orders()->where('stato', 'In consegna')->get();
        return $orders;
    }

    public function newOrder($d, $t)
    {
        $user = User::find(session('user_id'));
        $order = Order::create([
            'cliente' => $user->id,
            'data' => $d,
            'ora' => $t,
            'stato' => 'In consegna'
        ]);


        if($order)
        {
            return $order->id;
        }
        else
        {
            return view('home');
        }
    }

    public function completeorder($o, $p, $q)
    {
        $ordine=Order::find($o);
        $ordine->buy()->attach($p, ['quantita' => $q]);

        if(!$ordine)
        {
            echo ("non salvato");
        }
    }


    public function get_order_informations($o)
    {
        return (DB::select("SELECT r.id AS id_prodotto, totale, data, ora, r.nome AS prodotto, prezzo, quantita, indirizzo
        FROM cliente c JOIN (ordine o JOIN riepilogo r ON o.id=r.ordine) ON c.id=o.cliente WHERE ordine= ?
        ORDER BY id_prodotto asc" , [$o]));
    }

    public function delete_order($o)
    {
        $ordine = Order::find($o);
        $ordine->delete();
    }
}


?>