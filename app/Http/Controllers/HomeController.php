<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Cart;
use App\Models\Category;
use App\Models\HomeBanner;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\PrivacyPolicy;
use App\Models\Product;
use App\Models\RefundPolicy;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index ()
    {
        $hotProducts = Product::where('product_type','hot')->orderBy('id','desc')->get();
        $newProducts = Product::where('product_type','new')->orderBy('id','desc')->get();
        $regularProducts = Product::where('product_type','regular')->orderBy('id','desc')->get();
        $discountProducts = Product::where('product_type','discount')->orderBy('id','desc')->get();
        $homeBanner = HomeBanner::first();
        return view ('home.index',compact('hotProducts','newProducts','regularProducts','discountProducts', 'homeBanner'));
    }

    public function productDetails ($slug)
    {
        $product = Product::where('slug', $slug)->with('color', 'size', 'galleryImage')->first();
        return view ('home.product-details', compact('product'));
    }

    public function viewCart ()
    {
        return view ('home.view-cart');
    }

    public function productCheckout ()
    {
        
        return view ('home.checkout');
    }

    public function shopProduct (Request $request)
    {
        if(isset($request->categoryId)){
            $type = 'category';
            $categoryProducts = Category::where('id', $request->categoryId)->with('product')->first();
            return view ('home.shop', compact('categoryProducts', 'type'));
        }
        if(isset($request->subCategoryId)){
            $type = 'subCategory';
            $subCategoryProducts = SubCategory::where('id', $request->subCategoryId)->with('product')->first();
            return view ('home.shop', compact('subCategoryProducts', 'type'));
        }
        $type = 'normal';
        $products = Product::orderBy('id', 'desc')->get();
        return view ('home.shop', compact('products', 'type'));
    }

    public function returnProducts ()
    {
        return view ('home.return-product');
    }



    //Add to Cart......

    public function addtoCartDetails (Request $request, $id)
    {
        $cartProduct = Cart::where('product_id', $id)->where('ip_address', $request->ip())->first();
        $product = Product::where('id', $id)->first();
        $action = $request->action;

        if($cartProduct == null){
            $cart = new Cart();
            $cart->product_id = $id;
            $cart->ip_address = $request->ip();
            $cart->qty = $request->qty;
            if($product->discount_price != null){
                $cart->price = $product->discount_price;
            }
            elseif($product->discount_price == null){
                $cart->price = $product->regular_price;
            }

            $cart->size = $request->size;
            $cart->color = $request->color;

            $cart->save();
            if($action == 'addToCart'){
                toastr()->success('Added to cart!');
                return redirect()->back();
            }
            else{
                toastr()->success('Added to cart!');
                return redirect('product/checkout');
            }
        }
        elseif($cartProduct != null){
            $cartProduct->qty = $cartProduct->qty + $request->qty;
            $cartProduct->save();
            if($action == 'addToCart'){
                toastr()->success('Added to cart!');
                return redirect()->back();
            }
            else{
                toastr()->success('Added to cart!');
                return redirect('product/checkout');
            }
        }
    }

    public function addtoCart (Request $request, $id)
    {
        $cartProduct = Cart::where('product_id', $id)->where('ip_address', $request->ip())->first();
        $product = Product::where('id', $id)->first();

        if($cartProduct == null){
            $cart = new Cart();
            $cart->product_id = $id;
            $cart->ip_address = $request->ip();
            $cart->qty = 1;
            if($product->discount_price != null){
                $cart->price = $product->discount_price;
            }
            elseif($product->discount_price == null){
                $cart->price = $product->regular_price;
            }

            $cart->save();
            toastr()->success('Added to cart!');
            return redirect()->back();
        }

        elseif($cartProduct != null){
            $cartProduct->qty = $cartProduct->qty + 1;
            $cartProduct->save();
            toastr()->success('Added to cart!');
            return redirect()->back();
        }
    }

    public function deleteAddtoCart($id)
    {
        $cartProduct = Cart::find($id);
        $cartProduct->delete();

        // toastr()->success('Removed from cart!');
        return redirect()->back();
    }

     //Confirm Order...
     public function confirmOrder (OrderRequest $request)
     {
         $order = new Order();
 
         $previousOrder = Order::orderBy('id', 'desc')->first(); //10
 
         if($previousOrder == null){
             $order->invoiceId = 'MOM-1';
         }
         if($previousOrder != null){
             $generateInvoiceId = 'MOM-'.$previousOrder->id+1;
             $order->invoiceId = $generateInvoiceId; //MOM-11
         }
 
         $order->c_name = $request->c_name;
         $order->c_phone = $request->c_phone;
         $order->email = $request->email;
         $order->address = $request->address;
         $order->area = $request->area;
         $order->price = $request->inputGrandTotal;
 
         //Store Info into OrderDetails table...
         $cartProducts = Cart::with('product')->where('ip_address', $request->ip())->get();
         if($cartProducts->isNotEmpty()){
             $order->save();
             foreach($cartProducts as $cart){
                 $orderDetails = new OrderDetails();
 
                 $orderDetails->order_id   = $order->id;
                 $orderDetails->product_id = $cart->product_id;
                 $orderDetails->qty = $cart->qty;
                 $orderDetails->price = $cart->price;
                 $orderDetails->size = $cart->size;
                 $orderDetails->color = $cart->color;
 
                 $orderDetails->save();
                 $cart->delete();
             }
         }
         
         else{
             toastr()->warning('No products in your cart!!');
             return redirect('/');
         }
 
         toastr()->success('Order is placed successfully!');
         return redirect('order-confirmed/'.$generateInvoiceId);
     }

     public function thankyouMessage ($invoiceId)
     {
        return view('home.thankyou',compact('invoiceId'));
     }

     //Category Products......
     public function categoryProducts ($slug)
     {
        $categoryProducts = Category::where('slug', $slug)->with('product')->first();
        return view('home.category-products',compact('categoryProducts'));
     }

     public function subCategoryProducts ($slug)
     {
        $subCategoryProducts = SubCategory::where('slug', $slug)->with('product')->first();
        return view('home.category-products' ,compact('subCategoryProducts'));

     }

     public function searchProducts (Request $request)
     {
        if(isset($request->search)){
        $searchProducts = Product::where('name','LIKE','%'.$request->search.'%')->get();
            return view('home.search-products', compact('products'));
        }


     }

     //Inner Pages....

     public function privacyPolicy ()
    {
        $privacyPolicy = PrivacyPolicy::first();
        return view ('home.privacy-policy' ,compact('privacyPolicy'));
    }

    public function refundPolicy ()
    {
        $refundPolicy = RefundPolicy::first();
        return view('home.refund-policy' , compact('refundPolicy'));
    }

    }


