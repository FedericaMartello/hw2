<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Order extends Model
    {
        protected $table = 'ordine';

        protected $fillable = [
            'cliente', 'data', 'ora', 'stato'
        ];

        public function user()
        {
            return $this->belongsTo("App\Models\User");
        }

        public function buy()
        {
            return $this->belongsToMany("App\Models\Product", 'carrello', 'ordine', 'prodotto')->withPivot('quantita');
        }
    }
    

?>