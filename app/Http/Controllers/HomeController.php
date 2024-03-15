<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index ()
    {
        return view ('home.index');
    }

    public function productDetails ()
    {
        return view('home.product-details');
    }

    public function viewCart ()
    {
        return view ('home.view-cart');
    }

    public function productCheckout ()
    {
        return view ('home.checkout');
    }

    public function shopProducts ()
    {
        return view ('home.shop');
    }

    public function returnProducts ()
    {
        return view ('home.return-product');
    }

    public function privacyPolicy ()
    {
        return view ('home.privacy-Policy');
    }


    } 

