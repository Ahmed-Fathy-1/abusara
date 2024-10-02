<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\User;
use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Http\Traits\imagesTrait;
use App\Mail\TenantRegisterMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Artisan;
use App\Http\Requests\Admin\RegisterRequest;

class TenantController extends Controller
{
    use imagesTrait;

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function getRegister()
    {
        return view('Admin.pages.Auth.register');
    }

    public function getCharge()
    {
        return view('Admin.pages.stripe.charge');
    }

    public function pay()
    {
        $stripe = new \Stripe\StripeClient('sk_test_51OOMOtK2t4I8yGl8zwciXoc0RQSyxXM4aO97Ugl6dMftlc8Z4oCkVoTnzJUv7uZ5rKvXQxoD0cFrxQFJ4EmsfFnw00BYwKrA2U');

        $checkout_session = $stripe->checkout->sessions->create([
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'plan one',
                    ],
                    'unit_amount' => 2000,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => 'http://localhost:4242/success',
            'cancel_url' => 'http://localhost:4242/cancel',
        ]);

        return  redirect($checkout_session->url);

    }


    public function postRegister(RegisterRequest $request)
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'mobile' => $request->mobile,
        ]);

        try {
            $name = $request->name;
            $email = $request->email;
            $password = $request->password;
            $message = 'New customer logged in but not subscribed to the app';
            $phone = $user->mobile;

            Mail::to(env('MAIL_USERNAME'))
                ->send(new TenantRegisterMail($name, $email, $password, $message, $phone));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Email could not be sent. Please try again.');
        }
        

        // Use the `image` method from imagesTrait to handle image upload
        // if ($request->hasFile('image')) {
        //     $this->image($request->file('image'), 'users');
        // }


        // try {
        //     $name = $request->name;
        //     $email = $request->email;
        //     $password = $request->password;
        //     $message = 'this is email and password dashboard';
        //     $phone = $user->mobile;

        //     Mail::to($user->email)
        //         ->send(new TenantRegisterMail($name, $email, $password, $message, $phone));
        // } catch (\Exception $e) {
        //     return redirect()->back()->with('error', 'Email could not be sent. Please try again.');
        // }

        $tenant = Tenant::create([
            'id' => $request->tenant,
            'name' => $request->tenant,
            'user_id' => $user->id,
        ]);

        $tenant->domains()->create([
            'domain' => $request->tenant,
        ]);

        return redirect()->back()->with('success', 'Registration successful!');
    }
}
