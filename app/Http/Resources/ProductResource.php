<?php

namespace App\Http\Resources;

use App\Models\product;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource {
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
            'product_code'     => $this->product_code,
            'quantity'         => $this->quantity,
            'details'          => $this->details,
            'color'            => $this->color,
            'size'             => $this->size,
            'actual_price'     => $this->actual_price,
            'discount_price'   => $this->discount_price,
            'image'            => $this->image,
            'singleImage'      => $this->image ? json_decode( $this->image )[0] : '',
            'video_link'       => $this->video_link,
            'category_info'    => $this->category,
            'subcategory_info' => $this->subcategory,
            'brand_info'       => $this->brand,
            'featured'         => $this->featured,
            'hot'              => $this->hot,
            'sale'             => $this->sale,
            'top_rating'       => $this->top_rating,
            'best_selling'     => $this->best_selling,
            'similarProducts'  => product::where( 'subcategorie_id', $this->subcategorie_id )->get(),

        ];
    }
}
