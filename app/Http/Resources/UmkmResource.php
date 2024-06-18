<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class UmkmResource extends JsonResource
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
            'foto_umkm' => $this->when($user && $user->roles[0]->name == 'user', 'foto_umkm'),
            'nama_umkm' => $this->nama_umkm,
            'kota_umkm' => $this->kota_umkm,
            'lokasi_umkm' => $this->lokasi_umkm,
            'deskripsi' => $this->deskripsi,
            'kontak' => $this->kontak,
            'produk' => ProdukResource::collection($this->whenLoaded('produk')),
        ];
    }
}
