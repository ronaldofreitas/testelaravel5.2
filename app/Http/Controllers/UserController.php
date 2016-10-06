<?php
/*
TesteLaravel - desenvolvido por Ronaldo Freitas
Eu quero a porra desse emprego!
@author: Ronaldo Freitas / ronafreitasweb@gmail.com
*/
namespace TesteLaravel\Http\Controllers;
use Illuminate\Http\Request;
use TesteLaravel\Http\Requests;
use TesteLaravel\User;
use TesteLaravel\Http\Requests\UserRequest;
class UserController extends Controller {
	
 	/**
	 * Construtor que obriga autenticação nesse módulo
	 * @param int... paginação
	 * @return Array Object
	 */
    public function __construct(){
        $this->middleware('auth');
    }
 	/**
	 * Listar usuários
	 * @param int... paginação
	 * @return Array Object
	 */
    public function index(){
        //$usuarios = User::paginate(env(5));
        $usuarios = User::paginate(5);
        return view("usuarios/listagem", [ "usuarios" => $usuarios]);
    }
 	
 	/*
		form para criar usuários
 	*/
    public function create( ) {
        return view("usuarios/inserir");
    }

	/**
	 * Editar - recebe os dados no form
	 * @return Array Object
	 */
	public function edit( $id ) {
        $usuario = User::find($id);
        return view('usuarios/editar', [ 'usuario' => $usuario]);
	}


	/**
	 * Atualiza no banco
	 * usa o UserRequest (Request) para interagir com o Controller (use TesteLaravel\Http\Requests\UserRequest;)
	 * @param  UserRequest $request
	 *
	 * @return Response
	 */
	public function update ( UserRequest $request, $id ) {
        $usuario = User::find($id)->update(
        	[
	            'name' => $request['name'],
	            'email' => $request['email'],
	            'password' => bcrypt($request['password'])
            ]);
        return redirect()->route('usuario.index');
    }

	public function delete ( $id ) {
	        User::find($id)->delete();
	        return redirect()->route('usuario.index');
	}

	public function store ( UserRequest $request ) {
        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        ]);
        return redirect()->route('usuario.index');
	}
}