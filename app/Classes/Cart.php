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
        $this->cart->put($this->getNewId(), $item);
        session(['cart' => $this->cart]);
    }

    public function removeItem()
    {
        //removing item from cart
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
