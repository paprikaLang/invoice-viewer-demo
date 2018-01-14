<?php

namespace App\Http\Controllers;
use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function search(){
        $results = Customer::orderBy('firstName')
            ->when(request('q'),function ($query){
                $query->where('firstName','like','%'.request('q').'%')
                    ->orWhere('lastName','like','%'.request('q').'%')
                    ->orWhere('email','like','%'.request('q').'%');
            })
            ->limit(6)
            ->get();
        return response()
            ->json(['results' => $results]);
    }
}
