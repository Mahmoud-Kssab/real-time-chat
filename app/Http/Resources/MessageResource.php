<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $user_id = auth()->user()->id;


        return [

            'id'        => $this->id,
            'body'      => $this->body,
            'sender_name'      => $this->sender->name,
            'if_sender' => $user_id == $this->sender_id ? true : false

        ];
    }
}
