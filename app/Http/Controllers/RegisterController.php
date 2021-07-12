<?php
    namespace App\Http\Controllers;

    use Illuminate\Routing\Controller as BaseController;
    use User;
    use Hash;
    use Request;
    use Session;

    class RegisterController extends BaseController
    {
        public function create()
        {

            $request = request();
            if($this->checkErrors($request) === 0)
            {
                $new = User::create([
                    'username' => $request->username,
                    'password' => Hash::make($request->password),
                    'name' => $request->name,
                    'indirizzo' => $request->indirizzo,
                    'tel' => $request->tel
                ]);

                if($new)
                {
                    Session::put('user_id', $new->id);
                    return redirect('home');
                }
                else
                {
                    return redirect('home')->withInput();
                }
            }
            else
            {
                return redirect('signup')->withInput();
            }
        }

        private function checkErrors($data)
        {
            $errors = array();

            //Controllo PASSWORD
            if (strlen($data['password'])>5                 //almeno 5 caratteri
                && strlen($data['password'])<15             //al max 15 caratteri
                && preg_match('`[A-Z]`', $data['password']) //Alemno un carattere maiuscolo
                && preg_match('`[a-z]`', $data['password']) //Almeno un carattere minuscolo
                && preg_match('`[0-9]`', $data['password']) //Almeno un numero
                && (preg_match('`[?]`', $data['password']) || preg_match('`[@]`', $data['password']) || preg_match('`[_]`', $data['password'])|| preg_match('`[%]`', $data['password'])) //Caratteri speciali
            ){
                echo "Password valida";
            }else
            {
                $errors[] = "Caratteri non validi";
            }
                
            if(strcmp($data['password'], $data['test_password']) != 0)
            {
                $errors[] = "Le password non coincidono";
            }

            return count($errors);
        }


        public function checkUsername($query){
            $exists = User::where('username', $query)->exists();
            return ['exists' => $exists];
        }

        public function index()
        {
            return view('signup');
        }
    }
?>