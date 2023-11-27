<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function addorder(Request $request, $id){
        $orderData = $request->all();
        $validator = Validator::make($orderData, [
            'quantity' => 'required|min:1|numeric',
        ]);

        if ($validator->fails()){
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $service = Service::findOrFail($id);

        $user = User::findOrFail(Auth::id());

        if ($user->balance < $service->price*$orderData['quantity']){
            return back()
                ->withErrors(['money'=>'Недостаточно средств'])
                ->withInput();
        }

        $user->balance = $user->balance-$service->price*$orderData['quantity'];
        $user->save();
        
        $order = new Order();
        $order->user_id = Auth::id();
        $order->service_id = $id;
        $order->status_id = 1;
        $order->quantity = $orderData['quantity'];
        $order->cost = $service->price*$orderData['quantity'];
        $order->save();

        return redirect('orders');
    }
}
