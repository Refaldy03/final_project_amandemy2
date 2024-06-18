<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ProdukResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = Auth::user();
        return [
            'user' => $this->whenLoaded('user', new UserResource($this->user)),
            'foto_produk' => $this->when($user && $user->roles[0]->name == 'user', 'foto_produk'),
            'nama_produk' => $this->nama_produk,
            'harga' => $this->harga,
        ];
    }
}
