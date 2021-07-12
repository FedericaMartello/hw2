<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Ingredients extends Model
    {
        protected $table = 'ingrediente';
        
        public function inside()
        {
            return $this->belongsToMany("App\Models\Product", 'contiene', 'ingrediente', 'prodotto');
        }
    }

?>