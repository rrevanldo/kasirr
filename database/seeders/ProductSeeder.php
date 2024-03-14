<?php

namespace Database\Seeders;

use App\Models\LogStock;
use App\Models\Produk;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        $yearMonthDay = $now->format('y') . $now->format('m') . $now->format('d');
        $firstCode = "P".$yearMonthDay."1";
        $secondCode = "P".$yearMonthDay."2";
        $firstProduct = Produk::create([
            'product_name' => 'Mie Lidi',
            'price' => 5000,
            'stock' => 50,
            'code' => $firstCode,
        ]);
        $secondProduct = Produk::create([
            'product_name' => 'Makaroni',
            'price' => 2000,
            'stock' => 100,
            'code' => $secondCode,
        ]);
        LogStock::create([
            'user_id' => 1,
            'product_id' => $firstProduct->id,
            'description' => "Titipan dari bang aceng",
            'total_stock' => $firstProduct->stock
        ]);
        LogStock::create([
            'user_id' => 1,
            'product_id' => $secondProduct->id,
            'description' => "Produk baru",
            'total_stock' => $secondProduct->stock
        ]);
    }
}
