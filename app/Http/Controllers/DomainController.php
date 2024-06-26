<?php

namespace App\Http\Controllers;

use App\Mail\Email;
use App\Mail\OrderShipped;
use App\Models\Domain;
use App\Models\Publisher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class DomainController extends Controller
{

    public function index()
    {
        return view('domain.index');
    }


    public function create()
    {
        $publishers = Publisher::all();
        return view('domain.create', ['publishers' => $publishers]);
    }


    public function store(Request $request)
    {
        $validations = [
            'domain' => 'required',
            'revshare' => 'required',
            'status' => 'required',
        ];

        $feedbacks = [
            'domain.required' => "Domain it's a required field",
            'revshare.required' => "Revshare it's a required field",
            'status.required' => "Status it's a required field",
        ];

        $request->validate($validations, $feedbacks);

        $domain = new Domain();
            $domain->domain = $request->domain;
            $domain->revshare = $request->revshare;
            $domain->status = $request->status;

        if($request->publisher_id == ''){
            if(Auth::check()){
                $publisher = Auth::user();

                $publisher = Publisher::where('email', $publisher->email)->first();
                $domain['publisher_id'] = $publisher->id;
            }

        } else {
            $domain->publisher_id = $request->publisher_id;
        } 

        $domain->save();
        
        return redirect()->route('domain.index');
    }   


    public function show(Domain $domain)
    {
        return view('domain.show', ['domain'=> $domain]);
    }

   
    public function edit(Domain $domain)
    {
        $user = Auth::user();
        $publishers = Publisher::all();

        //Verfica se o usuario é um admin ou publisher
        if(Publisher::where('email', $user->email)->exists()){

            //Condição se o usuario for publisher
            $publisher = Publisher::where('email', $user->email)->first();

            //Tera acesso a editar somente os domains que pertencem a ele
            if($publisher->id == $domain->publisher_id){

                return view('domain.edit', ['publishers' => $publishers, 'domain' => $domain]);

            } else {

                return redirect()->route('domain.index');
            }

        } else {

            //Condição se ele for admin - tera acesso a editar todos os domains cadastrados
            return view('domain.edit', ['publishers' => $publishers, 'domain' => $domain]);
        }
    }


    public function update(Request $request, Domain $domain)
    {
        $validations = [
            'domain' => 'required',
            'revshare' => 'required',
            'status' => 'required',
        ];

        $feedbacks = [
            'domain.required' => "Domain it's a required field",
            'revshare.required' => "Revshare it's a required field",
            'status.required' => "Status it's a required field",
        ];

        $request->validate($validations, $feedbacks);
        $domain->update($request->all());

        return redirect()->route('domain.index');
    }


    public function destroy(Domain $domain)
    {
        $domain->delete();
        return redirect()->route('domain.index', ['domain' => $domain->id]);
    }
}
