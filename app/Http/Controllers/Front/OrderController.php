<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\ProductVariations;
use App\Models\Profile;
use App\Models\User;
use App\Traits\ActivationTrait;
use App\Traits\CaptureIpTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use jeremykenedy\LaravelRoles\Models\Role;

class OrderController extends Controller
{
    use ActivationTrait;

    public function checkout()
    {
        $cartItems = \Cart::getContent();

        if (empty($cartItems)) {
            return redirect()->route('shop');
        }

        return view('front.checkout.index', compact('cartItems'));
    }

    public function store(OrderRequest $request)
    {
        if (!Auth::check()) {
            $user = User::where('email', $request->email)->exists();
            if (!$user) {
                $user = $this->createUser($request->toArray());
            }

            Auth::login($user);
        }

        $user = Auth::user();

        //todo discount & coupon

        $amount =  \Cart::getTotal();
        $discount = 0;
        $finalAmount = \Cart::getTotal();

        $order = Order::create([
            'order_number'  => 'order-' . date('dmY') . '-' . str_pad($user->id, 3, 0, STR_PAD_LEFT),
            'user_id'       => $user->id,
            'phone'         => $request->phone,
            'email'         => $request->email,
            'country'       => $request->country,
            'city'          => $request->city,
            'state'         => $request->state,
            'zip'           => $request->zip,
            'address'       => $request->address,
            'coupon_id'     => null,
            'discount'      => $discount,
            'amount'        => $amount,
            'final_amount'  => $finalAmount,
            'notes'         => $request->notes
        ]);

        $items = $cartItems = \Cart::getContent();

        foreach ($items as $item){

            $productVariationId = ProductVariations::where([['product_id', $item->id], ['variation_id', $item->attributes->variation],
                ['variation_size_id', $item->attributes->size], ['variation_style_id', $item->attributes->style]])->pluck('id')->first();

            $order->details()->create([
                'product_id'            => $item->id,
                'price'                 => $item->price,
                'quantity'              => $item->quantity,
                'product_variation_id'  => $productVariationId
            ]);
        }

        \Cart::clear();

        return redirect()->route('order.thankyou', $order->order_number);
    }

    public function thankyou(Order $order)
    {
        return view('front.checkout.thankyou', compact('order'));
    }

    public function failed(Order $order)
    {
        return view('front.checkout.failed', compact('order'));
    }

    private function createUser($data)
    {
        $ipAddress = new CaptureIpTrait();
        $role = Role::where('slug', '=', 'unverified')->first();

        $username = Str::lower(Str::slug($data['first_name'] . '-'. $data['last_name']));

        $user = User::create([
            'name'              => $username,
            'first_name'        => $data['first_name'],
            'last_name'         => $data['last_name'],
            'email'             => $data['email'],
            'phone'             => $data['phone'],
            'password'          => Hash::make('X9Z1C2R3'),
            'token'             => str_random(64),
            'signup_ip_address' => $ipAddress->getClientIp(),
            'activated'         => ! config('settings.activation'),
        ]);

        $user->attachRole($role);

        $profile = new Profile();
        $profile->country = $data['country'];
        $profile->city = $data['city'];
        $profile->state = $data['state'];
        $profile->zip = $data['zip'];
        $profile->location = $data['address'];
        $user->profile()->save($profile);
        $user->save();

        $this->initiateEmailActivation($user);

        return $user;
    }
}
