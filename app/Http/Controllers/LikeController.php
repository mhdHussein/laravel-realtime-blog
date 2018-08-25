<?php

namespace App\Http\Controllers;

use App\Model\Like;
use Illuminate\Http\Request;
use App\Model\Reply;
use App\Http\Resources\ReplyResource;
use Illuminate\Http\Response;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('JWT');
    }

    public function likeIt(Reply $reply){

        $reply->like()->create([
            // 'user_id' => auth()->id()
            'user_id' => '1'
        ]);

        return response(new ReplyResource($reply) , Response::HTTP_CREATED);

    }

    public function unlikeIt(Reply $reply){

        // $reply->like()->where('user_id' , auth()->id())->first()->delete();
        $reply->like()->where('user_id' , '1')->first()->delete();

        return response(null , Response::HTTP_ACCEPTED);
    }
}
