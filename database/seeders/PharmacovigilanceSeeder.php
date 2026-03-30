<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PharmacovigilanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('customers')->insert([
            ['name'=>'Juan Perez','email'=>'juan@test.com','phone'=>'3001111111'],
            ['name'=>'Maria Lopez','email'=>'maria@test.com','phone'=>'3002222222'],
            ['name'=>'Carlos Ruiz','email'=>'carlos@test.com','phone'=>'3003333333'],
            ['name'=>'Ana Torres','email'=>'ana@test.com','phone'=>'3004444444'],
            ['name'=>'Luis Gomez','email'=>'luis@test.com','phone'=>'3005555555']
        ]);

        DB::table('medications')->insert([
            ['name'=>'Paracetamol','lot_number'=>'951357'],
            ['name'=>'Ibuprofeno','lot_number'=>'951357'],
            ['name'=>'Amoxicilina','lot_number'=>'888111'],
            ['name'=>'Acetaminofen','lot_number'=>'951357'],
            ['name'=>'Diclofenaco','lot_number'=>'777222']
        ]);

        DB::table('orders')->insert([
            ['customer_id'=>1,'purchase_date'=>Carbon::now()->subDays(5)],
            ['customer_id'=>2,'purchase_date'=>Carbon::now()->subDays(4)],
            ['customer_id'=>3,'purchase_date'=>Carbon::now()->subDays(3)],
            ['customer_id'=>4,'purchase_date'=>Carbon::now()->subDays(2)],
            ['customer_id'=>5,'purchase_date'=>Carbon::now()->subDays(1)]
        ]);

        DB::table('order_items')->insert([
            ['order_id'=>1,'medication_id'=>1],
            ['order_id'=>1,'medication_id'=>2],
            ['order_id'=>2,'medication_id'=>1],
            ['order_id'=>3,'medication_id'=>4],
            ['order_id'=>4,'medication_id'=>2],
            ['order_id'=>5,'medication_id'=>1],
            ['order_id'=>2,'medication_id'=>4],
            ['order_id'=>3,'medication_id'=>1],
            ['order_id'=>4,'medication_id'=>1],
            ['order_id'=>5,'medication_id'=>2]
        ]);
    }
}
