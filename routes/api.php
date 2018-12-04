<?php


use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\NotificationResource;
use Illuminate\Http\Request;

Route::apiResource('/question' , 'QuestionController');

Route::apiResource('/category' , 'CategoryController');

Route::apiResource('/question/{question}/reply' , 'ReplyController');

Route::post('/like/{reply}' , 'LikeController@likeIt');
Route::delete('/like/{reply}' , 'LikeController@unlikeIt');

Route::post('notifications' , function(){
    return [
        'read' => NotificationResource::collection(auth()->user()->readNotifications()->get()),
        'unread' => NotificationResource::collection(auth()->user()->unreadNotifications()->get())
    ];
});

Route::post('markAsRead' , function(Request $request){
    
    auth()->user()->notifications->where('id' , $request->id)->markAsRead();

    return response(null , Response::HTTP_CREATED);

});

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});