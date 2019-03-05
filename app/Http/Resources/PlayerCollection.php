<?php

namespace App\Http\Resources;

use App\Team;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PlayerCollection extends ResourceCollection
{

    protected $team;

    /**
     * Create a new resource instance.
     *
     * @param  mixed  $resource
     * @return void
     */
    public function __construct($resource, Team $team)
    {
        $this->team = $team;

        parent::__construct($resource);
    }

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'team_admin' => $this->team->user,
            'team' => $this->team,
            'data' => $this->collection,
        ];
    }
}
