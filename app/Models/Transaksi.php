<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function paket() {
        return $this->belongsTo(Paket::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function metode() {
        return $this->hasOne(MtdPembayaran::class,'id','mtd_pembayaran_id');
    }

}
