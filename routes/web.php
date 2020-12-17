<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('profile', 'ProfileController@index')->name('profile');

Route::middleware(['adminCheck'])->group( function() {

    Route::get('customize', function(){
        return view('customize.index');
    })->name('customize');

    Route::get('customize/train', 'CustomizeController@index')
        ->name('customizeTrain');

    Route::post('customize/train', 'CustomizeController@store')
        ->name('customizeTrainStore');

    Route::post('customize/places', 'CustomizePlaces@store')
        ->name('customizePlaces');

    Route::get('customize/station', 'StationController@index')
        ->name('customizeStation');

    Route::post('customize/station', 'StationController@store')
        ->name('customizeStationStore');

    Route::get('customize/arrives', 'ArrivesController@index')
        ->name('customizeArrives');

    Route::post('customize/arrives', 'ArrivesController@store')
        ->name('customizeArrivesStore');
});

Route::middleware(['auth'])->group( function() {

    Route::post('buyTicket/traceFind', 'TraceFindController@store')
        ->name('buyTicketStore');

    Route::post('buyTicket/choosePlace', 'ChoosePlacesController@store')
        ->name('choosePlace');

    Route::post('buyTicket/reasume', 'ReasumeController@index')
        ->name('reasume');

    Route::get('buyTicket/traceFind', 'TraceFindController@index')
        ->name('buyTicket');

});

Route::get('buyTicket/traceFind', 'TraceFindController@index')
    ->name('buyTicket');


Route::get('getStations/{trace_name}', 'ArrivesController@get');














Route::post('payForTicket', function(){
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://secure.payu.com/pl/standard/user/oauth/authorize");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);

    curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials&client_id=145227&client_secret=12f071174cb7eb79d4aac5bc2f07563f");

    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Content-Type: application/x-www-form-urlencoded"
    ));

    $response = curl_exec($ch);
    curl_close($ch);

    $response_decoded = json_decode($response);
    $access_token = $response_decoded->{'access_token'};

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://secure.payu.com/api/v2_1/orders/");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);

    curl_setopt($ch, CURLOPT_POST, TRUE);

    curl_setopt($ch, CURLOPT_POSTFIELDS, "{
    \"notifyUrl\": \"http://127.0.0.1/home\",
    \"continueUrl\": \"http://127.0.0.1:8000/continue\",
    \"customerIp\": \"127.0.0.1\",
    \"merchantPosId\": \"145227\",
    \"description\": \"RTV market\",
    \"currencyCode\": \"PLN\",
    \"totalAmount\": \"210\",
    \"products\": [
        {
        \"name\": \"Wireless mouse\",
        \"unitPrice\": \"150\",
        \"quantity\": \"1\"
        },
        {
        \"name\": \"HDMI cable\",
        \"unitPrice\": \"60\",
        \"quantity\": \"1\"
        }
    ]
    }");

    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Content-Type: application/json",
    "Authorization: Bearer ".$access_token
    ));

    $response = curl_exec($ch);
    curl_close($ch);

    $response = json_decode($response);
    $redirect = $response->{'redirectUri'};

    return redirect($redirect);

})->name('payForTicket');

Route::get('/continue', function(){
    echo 'You successfully create order';
});