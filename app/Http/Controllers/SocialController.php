<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Socialite;
use App\User;
use Auth;
use App\Http\Controllers\Controller;

class SocialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
    

        $user = Socialite::driver('facebook')->user();
        # Registro en la base de datos
        $db = User::where('id_social', $user->getId())->first();
                
        if($db)
        {
            //$db = User::where('id_social',$user->getId())->first();
            
            // Usurio registrado
            if (Auth::attempt(['id_social' => $user->getId(), 'password' => '123456'])) 
                {
                    
                    // Authentication passed...
                    return redirect()->intended('ingreso');
                    
                }
            
        }else
        {
            //(dd('else');
            // usuario nuevo
            
            $nuevo = new User();
            $nuevo->id_social       = $user->getId();
            $nuevo->username        = $user->getName();
            $nuevo->avatar          = $user->getAvatar();
            $nuevo->name            = $user->getName();
            $nuevo->email           = $user->getEmail();
            $nuevo->password        = '$2y$10$qCmaxJthB/EBN0iaqVl6JeNw1dnYLxvZOai8fhFjtOxv0KAj5dcbu';  // password generado la contraseña es 123456
            $nuevo->social_token    = $user->token;
            
            if($nuevo->save())
            {
                
                if (Auth::attempt(['id_social' => $user->getId(), 'password' => '123456'])) 
                {
                    // Authentication passed...
                    return redirect()->intended('ingreso');
                }
            }
            
            
        }
       
        
    }
}
