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

        $company = User::findOrFail($service->user_id);

        $client = User::findOrFail(Auth::id());

        if ($client->balance < $service->price*$orderData['quantity']){
            return back()
                ->withErrors(['money'=>'Недостаточно средств'])
                ->withInput();
        }

        $client->balance = $client->balance-$service->price*$orderData['quantity'];
        $client->save();

        $company->balance = $company->balance+$service->price*$orderData['quantity'];
        $company->save();
        
        $order = new Order();
        $order->user1_id = $client->id;
        $order->user2_id = $company->id;
        $order->service_id = $id;
        $order->status_id = 1;
        $order->quantity = $orderData['quantity'];
        $order->cost = $service->price*$orderData['quantity'];
        $order->save();

        return redirect('orders');
    }

    public function delorder($id){

        $order = Order::findOrFail($id);
        $order->status_id = 2;
        $order->save();

        $client = User::findOrFail($order->user1_id);
        $client->balance = $client->balance+$order->cost;
        $client->save();

        $company = User::findOrFail($order->user2_id);
        $company->balance = $company->balance-$order->cost;
        $company->save();

        return back();
    }

    public function changestatus($id){

        $order = Order::findOrFail($id);
        if ($order->status_id === 1) {
            $order->status_id = 3;
        } elseif ($order->status_id === 3){
            $order->status_id = 4;
        }
        $order->save();

        return back();
    }
}
