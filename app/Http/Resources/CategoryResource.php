<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Routing\Route;

class CategoryResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray( $request ) {
        return [
            'id'               => $this->id,
            'name'             => $this->name,
            'description'      => $this->description,
            'image'            => $this->image,
            //'slug'        => URL::to( '/' ) . "/api/v1/frontend/single-category/" . $this->id,
            'slug'             => route( 'singleCategory', $this->id ),
            'subcategory'      => $this->subcategory,
            'totalSubcategory' => count( $this->subcategory ),
            'totalProduct'     => count( $this->products ),

        ];
    }
}
