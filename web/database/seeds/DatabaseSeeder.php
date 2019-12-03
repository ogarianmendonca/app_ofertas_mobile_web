<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Oferta;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        if(User::where('email', '=', 'admin@email.com')->count()){
            $user = User::where('email', '=', 'admin@email.com')->first();
        }else{
            $user = new User;
        }
        $user->name = "Admin";
        $user->email = "admin@email.com";
        $user->password = bcrypt("123456");
        $user->save();

        $oferta = [
            'titulo' => 'Carne',
            'descricao' => 'Carnde de primeira',
            'validade' => '2018-10-30',
            'valor' => 19.90,
            'valor_formatado' => 'R$ 19,90',
            'imagem' => 'teste.png'
        ];
        Oferta::create($oferta);
    }
}
