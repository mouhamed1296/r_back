<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Commande;
use App\Models\Personne;
use Termwind\Components\Dd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Http\Controllers\PersonneController;
use Illuminate\Support\Facades\Date;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }

    public function findOneUser($id)
    {
        return User::find($id);
    }

    public function findRole($id)
    {
        // return User::find($id)->roleCompte->livreur;
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    public function listeLivreurs()
    {
        $livreurs = User::where('roleCompte', 'livreur')
            ->join('personnes', 'users.personne_id', '=', 'personnes.id')
            ->orderBy('users.id')
            ->get();
        return $livreurs;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->update([
            'email' => $request->email,
            'password' => $request->password,
        ]);
        $personne_to_update = Personne::where('id',$user->personne_id)->get()->first();

        $personne_to_update->update([
            'civilite' => $request->civilite,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'telephone' => $request->telephone,
            'adress' => $request->adress,
            'disponibilite' => $request->disponibilite,
        ]);
        
    }
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
       
       $user = User::findOrFail($request->id);
       $user->delete([
            'email' => $request->email,
            'password' => $request->password,
        ]);
        $personne_to_delete = Personne::where('id',$user->personne_id)->get()->first();
        $personne_to_delete->delete([
            'civilite' => $request->civilite,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'telephone' => $request->telephone,
            'adress' => $request->adress,
            'disponibilite' => $request->disponibilite,
        ]);

        $personne = Personne::find($request->id);
        if ($personne) {
            $personne->delete();
            return response()->json([
                'success' => 'Personne supprimée avec success',
            ], 200);
        }


    }

    // public function search($roleCompte)
    // {
    //     return User::where('roleCompte', $roleCompte)->get();
    // }
   


 

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'civilite' => 'required|string',
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'telephone' => 'required|string',
            'disponibilite' => 'required|string',   
            'roleCompte' => 'required|string',
        ]);
        Personne::create([
            'civilite' => $request->civilite,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'telephone' => $request->telephone,
            'disponibilite' => $request->disponibilite,
        ]);


        $user = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'dateOuverture' => Carbon::now(),
            'roleCompte' => $request->roleCompte,
            'personne_id' => Personne::latest()->first()->id,

        ]);
        return response()->json([
            'success' => 'User créé avec success',
        ], 200);

        $user = new User();
        $token = $user->createToken('MyApp')->accessToken;
        return response()->json(['token' => $token, 'user' => $user], 200);
    }



    public function login(Request $request)
    {
       
        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (auth()->attempt($data)) {
            
            /**
             * @var \App\Models\User $user
             * 
             * **/
            $user = auth::user();

            $token = $user->createToken('myToken')->accessToken;
            return response()->json(['token'=>$token, 'roleCompte' => $user -> roleCompte, 'uid' => $user->id], 200);
        }else{
            return response()->json(['error'=>'unauthorized'], 401);
        }
    }

    public function userInfo()
    {
        $user = auth()->user();
        return response()->json(['email'=> $user->email, 'password'=> $user->password], 200);
    }
}