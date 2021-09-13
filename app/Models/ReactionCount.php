<?php
namespace App\Models;

use App\Models\Stamp;
use Illuminate\Support\Facades\Auth;

class ReactionCount 
{

    public $stamp;
    public $reactions;
    public function __construct(Stamp $stamp, $reactions)
    {
        $this->stamp = $stamp;
        $this->reactions = collect($reactions);
    }

    public function toArray()
    {
        return [
            'stamp' => $stamp,
            'reactions' => $reactions
        ];
    }

    public function isReacted()
    {
        return $this->reactions->contains(function($reaction){
            return $reaction->user_id == Auth::id();
        });
    }

}