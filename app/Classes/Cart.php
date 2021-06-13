<?php

namespace App\Classes;

class Cart
{
    private $cart = null;
    private $id = 0;
    //Custom Cart Class
    public function __construct()
    {
        if (session('cart'))
        {
            $this->cart = session('cart');
            $this->id = session('cartitemid');
        }
        else
        {
            session(['cart' => collect()]);
            session(['cartitemid' => 0]);
            $this->cart = session('cart');
            $this->id = session('cartitemid');
        }
    }

    public function addItem($item)
    {
        //Adding item to cart
        $this->cart = session('cart');
        $common = $this->cart->map(function($value, $key) use ($item){
            if($value['distributorid'] == $item['distributorid'] && $value['medicineid'] == $item['medicineid'])
            {
                return [$key, $value];
            }
        });
        if($common->isNotEmpty())
        {
            $common[0][1]['totalprice'] += $item['totalprice'];
            $common[0][1]['quantity'] += $item['quantity'];
            $item = $common[0][1];
            $this->cart->put($common[0][0], $item);
            session(['cart' => $this->cart]);
        }
        else
        {
            $this->cart->put($this->getNewId(), $item);
            session(['cart' => $this->cart]);
        }
    }

    public function removeItem($id)
    {
        //removing item from cart
        $this->cart = session('cart');
        if ($this->cart->count() == 1)
        {
            session(['cart' => collect()]);
        }
        else
        {
            $this->cart->pull($id);
            session(['cart' => $this->cart]);
        }
    }

    public function checkout()
    {
        //Creating Orders
    }

    public function getCart()
    {
        $this->cart = session('cart');
        return $this->cart;
    }

    public function getNewId()
    {
        $id = session('cartitemid');
        session(['cartitemid' => $id + 1]);
        return $id;
    }
}

?>
