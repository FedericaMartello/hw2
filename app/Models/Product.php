<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Product extends Model
    {
        protected $table = 'prodotto';
        
        public function buy()
        {
            return $this->belongsToMany("App\Models\Order", 'carrello', 'prodotto', 'ordine')->withPivot('quantita');
        }

        public function contain()
        {
            return $this->belongsToMany("Ingredients", 'contiene', 'prodotto', 'ingrediente');
        }
    }

?>