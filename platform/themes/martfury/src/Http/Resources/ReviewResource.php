<?php

namespace Theme\Martfury\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        $str  =$this->user->name;
        $len = strlen($this->user->name);
        if($len>10)
        {
            $myName = substr($str, 0, 2).'******'.substr($str, $len - 2, 2);
        }
        else{
            $myName = substr($str, 0, 2).str_repeat('*', $len - 2).substr($str, $len - 2, 2);
        }
        return [
            'user_name'   => $myName,
            'user_avatar' => $this->user->avatar_url,
            'created_at'  => $this->created_at->format('d M, Y'),
            'comment'     => $this->comment,
            'star'        => $this->star,
        ];
    }
}
