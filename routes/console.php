<?php

use App\Actions\Order\StoreOrder;
use App\Models\User;
use Davidnadejdin\LaravelAlfabank\Alfabank;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Voronkovich\SberbankAcquiring\Client;
use Voronkovich\SberbankAcquiring\Currency;
use Voronkovich\SberbankAcquiring\HttpClient\HttpClientInterface;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Artisan::command('lol', function () {
    dd(app()->make(TinkoffClient::class));
    $orderId = \Ramsey\Uuid\Uuid::uuid4();
    $amount = 1000;
//    $x = new Alfabank();
//    dd($x);
//    $a = Alfabank::register([
//        'userName'=>'asd',
//        'password'=>'asd',
//        'orderNumber'=>$order,
//        'amount'=>$amount,
//        'returnUrl'=>'asd'
//    ]);
//    dd($a);
    $client = new Client([
        'userName' => 'test-api',
        'password' => 'test',
        'language' => 'ru',
        'currency' => Currency::RUB,
        'apiUri' => 'https://alfa.rbsuat.com',
        'httpMethod' => HttpClientInterface::METHOD_GET,
    ]);
    $clientId = \Ramsey\Uuid\Uuid::uuid4()->toString();
    $orderId = $orderId->getHex()->toString();
    $orderAmount = 1000;
    $returnUrl = 'http://mycoolshop.local/payment-success';
    $params['failUrl'] = 'http://mycoolshop.local/payment-failure';
    //автоплатеж
    $params['clientId'] = $clientId;
    $result = $client->registerOrder($orderId, $orderAmount, $returnUrl, $params);
    dd($result);


});

Artisan::command('reg', function () {
//    $u = User::first();
//
//    $s= new \App\Models\Subscription();
//    $s->status = \App\Models\Subscription::STATUS_INIT;
//    $s->user_id = $u->id;
//    $s->traffic_id = \App\Models\Tariff::first()->id;
////    $s->save();
////    $u = \Ramsey\Uuid\Uuid::uuid4();
////    var_dump($u);
////    $h = $u->getHex();
////    var_dump($h);
////    $s = $h->toString();
////    var_dump($s);
   $u = new \App\Models\User();
   $u->name = 'test';
   $u->email = 'e@e.com';
   $u->password = \Illuminate\Support\Facades\Hash::make('123123');
   $u->save();
//   dd(auth()->user());

});

Artisan::command('qwe', function () {
    $client = new Client([
        'userName' => 'test-api',
        'password' => 'test',
        'language' => 'ru',
        'currency' => Currency::RUB,
        'apiUri' => Client::API_URI_TEST,
        'httpMethod' => HttpClientInterface::METHOD_GET,
    ]);


    $s = $client->getOrderStatus('08476c36-9f4a-7b8b-80b8-5a74000005d2');
    dd($s);
});


Artisan::command('asd', function () {
    $clientId = \Ramsey\Uuid\Uuid::uuid4()->toString();
    $bindingId = '6bd3326d-ffda-774a-9809-0e45000005d2';
    $client = new Client([
        'userName' => 'test-api',
        'password' => 'test',
        'language' => 'ru',
        'currency' => Currency::RUB,
        'apiUri' => Client::API_URI_TEST,
        'httpMethod' => HttpClientInterface::METHOD_GET,
    ]);
//    $res = $client->paymentOrderBinding('417d98d7-5e03-7457-b381-e412000005d2',$bindingId,['cvc'=>123]);
//    dd($res);

//    $clientId = \Ramsey\Uuid\Uuid::uuid4()->getHex()->toString();
    $orderId = \Ramsey\Uuid\Uuid::uuid4();

    $orderId = $orderId->getHex()->toString();
    $orderAmount = 1000;
    $returnUrl = 'http://mycoolshop.local/payment-success';
    $params['failUrl'] = 'http://mycoolshop.local/payment-failure';
    //автоплатеж
    $params['clientId'] = $clientId;
//    $params['features'] = 'AUTO_PAYMENT';
    $result = $client->registerOrder($orderId, $orderAmount, $returnUrl, $params);
    dd($result);
    $z = 'fa7f13f2-fdfa-7786-98ef-8c48000005d2';
});

Artisan::command('test:static', function (){

    $a = null;

    $f = function () {
        static $s;

        if(!isset($s)) {
            $s = function (){
                static $s = 0;
                return $s++;
            };
        }

        return $s;
    };

    dump($f()());
    dump($f()());
});



Artisan::command('zzz', function (){
    $u = \Ramsey\Uuid\Uuid::uuid4();
    $o = new StoreOrder(20,$u);
    dd($o);
});
