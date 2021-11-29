<?php

namespace App\Service;

use App\Entity\Dishes;
use App\Entity\Order;

class StripeService 
{
    private $privateKey;

    public function __construct()
    {
        // Générer 2 clés privé pour la prod lors de l'activation du compte stripe
        if($_ENV['APP_ENV'] === 'dev'){
             // après activation du compte stripe  $this->privateKey == $_ENV['STRIPE_SECRET_KEY_TEST'];
            $this->privateKey == $_ENV['STRIPE_SECRET_KEY_TEST'];
        } // else{
            // après activation du compte stripe  $this->privateKey == $_ENV['STRIPE_SECRET_KEY_LIVE'];
            // $this->privateKey == $_ENV['STRIPE_SECRET_KEY_TEST'];
        // }
    }

    public function paymentIntent(Dishes $dishes){

        \Stripe\Stripe::setApiKey($this->privateKey);

        return \Stripe\PaymentIntent::create([
            'amount' => $dishes->getPrice() * 100,
            'currency' => Order::DEVISE,
            'payment_method_types' => ['card']
        ]);
    }
    
    public function payment($amount, $currency, $description, array $stripeParameter){
        \Stripe\Stripe::setApiKey($this->privateKey);
        $payment_intent = null;

        if(isset($stripeParameter['stripeIntentId'])){
            $payment_intent = \Stripe\PaymentIntent::retrieve($stripeParameter['stripeIntentId']);
        }

        if($stripeParameter['stripeIntentId'] === 'succeeded'){
            // TODO listener
        }else{
            return $payment_intent->cancel();
        }

        return $payment_intent;
    }

    public function stripe(array $stripeParameter, Dishes $dishes)
    {
        return $this->payment(
            $dishes->getPrice() * 100,
            Order::DEVISE,
            $dishes->getName(),
            $stripeParameter
        );
    }
}

