<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use App\Models\User;

use App\Models\Product; 

use App\Models\Cart;

use App\Models\Order; 


class HomeController extends Controller
{
	public function redirect()
	{
		$usertype=Auth::user()->usertype; 

		if($usertype=='1')
		{
			return view('admin.home');
		} 
		else
		{
			$data = product::paginate(3); 
			$user=auth()->user();
			$count=cart::where('phone',$user->phone)->count();
			return view('user.home', compact('data','count')); 
		}
	} 

	
	public function ourproducts()
    {
		$data = product::paginate(6); 
    	return view('ourproducts', compact('data')); 
    } 
 
	public function index()
	{
		if(Auth::id()){
			return redirect('redirect');
		}else 
		{
			$data = product::paginate(3);
			return view('user.home',compact('data'));  
		}
	}
		
  
  public function search(Request $request)
  {
  	$search=$request->search;  
  	if($search=='')
  	{
  		$data = product::paginate(3);
		return view('user.home',compact('data'));
  	}
  	$data=product::where('title','Like','%'.$search.'%')->get();
  	return view('user.home',compact('data')); 
  }
 

  public function addcart(Request $request, $id)
  {
  	if(Auth::id())
  	{
  		// $user=auth()->user();
  		// $product=product::find($id); 
  		// $cart=new cart; 
  		// $cart->name=$user->name; 
  		// $cart->phone=$user->phone; 
  		// $cart->address=$user->address; 
  		// $cart->product_title=$product->title; 
  		// $cart->price=$product->price; 
  		// $cart->quantity = $request->quantity; 
  		// $cart->save(); 
  		// return redirect()->back()->with('message','Product Added Successfully'); 
		$user=auth()->user();
  		$product=product::find($id); 
		$res = Cart::create([
			'name'=>$user->name,
			'phone'=>$user->phone,
			'address'=>$user->address,
			'product_title'=>$product->title,
			'quantity'=>$request->quantity,   
			'price'=>$product->price,
		]);
  	} 
	if($res){     
		return redirect()->back()->with("message", "Product Added Successfully");
	}else{
    	return redirect('login'); 
    }
  }

  public function topthree(Request $request){
  	if(Auth::id()){
		  $data=Product::paginate(3);
		 
	}else{
    	return redirect('login'); 
    }
  }


  public function showcart()
  {
		$user=auth()->user();
		$cart=cart::where('phone',$user->phone)->get(); 
		$count=cart::where('phone',$user->phone)->count();
  	return view('user.showcart',compact('count','cart'));  
  }
    

   public function deletecart($id)
   {
   	$data=cart::find($id);
   	$data->delete();
   	return redirect()->back()->with('message','Product Removed Successfully'); 
   }


   public function confirmorder(Request $request)
   {
   	$user=auth()->user();
   	$name=$user->name;
   	$phone=$user->phone;
   	$address=$user->address;
   	// foreach ($request->productname as $key=>$productname)
   	// {
   	// 	 	$order=new order; 
   	// 	 	$order->product_name=$request->productname[$key];
   	// 	 	$order->price=$request->price[$key];
   	// 	 	$order->quantity=$request->quantity[$key];$res
   	// 	 	$order->name=$name;
   	// 	 	$order->phone=$phone;
   	// 	 	$order->address=$address; 
   	// 	 	$order->status='not delivered';  
   	// 	 	$order->save();
   	// } 
   	// Cart::where('phone',$phone)->delete(); 
	foreach ($request->productname as $key=>$productname){
		$res = Order::create([
			'name'=>$name,
			'phone'=>$phone,
			'address'=>$address,
			'product_name'=>$request->productname[$key],
			'quantity'=>$request->quantity[$key],   
			'price'=>$request->price[$key], 
			'status'=>$request->status='not delivered',  
		]);
	}
	 if($res){     
	 	Cart::where("phone", $user->phone)->delete();
		return redirect()->route("showcart")->with("message", "Order has been placed successfully!");
	}
   }

}  
