<?php namespace Hopkins\Slackemon\Game;

use Hopkins\Slackemon\Models\Player;
use Input;
use Response;
use Illuminate\Routing\Controller;

class BasePokemonController extends Controller{
    public function __construct(Cards $cards)
    {
        $this->cards = $cards;
    }

    public function deal()
    {
        $playerUserName = Input::get('user_name');
        $this->cards->deal($playerUserName);
        return Response::json(['message'=>'success']);
    }

    public function play()
    {
        $playerUserName = Input::get('user_name');
        $cardId = Input::get('text');
        $this->cards->play($playerUserName, $cardId);
        return Response::json(['message'=>'success']);
    }

    public function choose()
    {
        $cardId = Input::get('text');
        $playerUserName = Input::get('user_name');
        $this->cards->choose($playerUserName, $cardId);
        return Response::json(['message'=>'success']);
    }

    public function quit()
    {
        Player::find(Input::get('id'))->update(['cards' => 0]);
        return Response::json(['message'=>'success']);
    }

    public function show()
    {
        $playerUserName = Input::get('user_name');
        $this->cards->show($playerUserName);
        return Response::json(['message'=>'success']);
    }

    public function start(){
        $this->cards->start();
    }

    public function status(){
        $this->cards->status();
    }
}
