<?php

    use Illuminate\Database\Eloquent\Model;

    class User extends Model
    {
        protected $hidden = ['password'];
        protected $table = 'cliente';

        protected $fillable = [
            'username', 'password', 'name', 'indirizzo', 'tel'
        ];

        public function orders()
        {
            return $this->hasMany('App\Models\Order', "cliente");
        }
    }

?>