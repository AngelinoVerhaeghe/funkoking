<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public $products = null;
    public $totalQuantity = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
        //Als ik iets binnen krijg?
        if ($oldCart){
            $this->products = $oldCart->products;
            $this->totalQuantity = $oldCart->totalQuantity;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($product, $product_id){
        //In array alles bijhouden van aangeklikte producten
        //Assicioative array
        $shopItems = [
            'quantity' => 0,
            'product_id' => 0,
            'product_name' => $product->name,
            'product_price' => $product->price,
            'product_image' => $product->photo->file,
            'product_description' => $product->description,
            //Apparte array van het volledige product
            'product' => $product
        ];

        //Als er productezn zijn, geen 0
        if ($this->products){
            if (array_key_exists($product_id, $this->products)){
                $shopItems = $this->products[$product_id];
            }
        }
        //Telkens er een item bij komt verhoogt de Quantity
        $shopItems['quantity']++;
        //Als er effectief een item is moeten we die array gaan vullen: (Met echte waarden)!
        $shopItems['product_id'] = $product_id;
        $shopItems['product_name'] = $product->name;
        $shopItems['product_price'] = $product->price;
        $shopItems['product_image'] = $product->photo->file;
        $shopItems['product_description'] = $product->description;

        //Ook het Totaal quantity verhogen volledige CART
        $this->totalQuantity++;

        //Ook de prijs: = Totale prijs = Totale prijs + Product prijs die binnen komt.
        $this->totalPrice += $product->price;

        //Dan het volledige array van shopItems, in 1 product ID steken.
        $this->products[$product_id] = $shopItems;
    }

    public function updateQuantity($id, $quantity){
        //Telt het totaal aantal items in de winkelwagen gaan tellen
        //Aftrekken van de oldCart
        $this->totalQuantity -= $this->products[$id]['quantity'];
        //Dan pas de nieuwe erbij tellen
        $this->totalQuantity += $quantity;

        //Alls die quantity kleiner is dan de quantity die in de store zat
        if($this->products[$id]['quantity'] < $quantity){
            $this->totalPrice -= ($this->products[$id]['quantity'] * $this->products[$id]['product_price']);
            $this->totalPrice += $quantity * $this->products[$id]['product_price'];
        }else{
            $this->totalPrice -= ($this->products[$id]['quantity'] - $quantity) * $this->products[$id]['product_price'];
        }
        $this->products[$id]['quantity'] = $quantity;
        //dan terug naar PagersController
    }

    public function removeItem($id){
        $this->totalQuantity -= $this->products[$id]['quantity'];
        $this->totalPrice -= ($this->products[$id]['quantity'] * $this->products[$id]['product_price']);
        unset($this->products[$id]);
    }

}
