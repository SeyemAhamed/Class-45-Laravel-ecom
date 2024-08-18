<?php

namespace Database\Seeders;

use App\Models\RefundPolicy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RefundPolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $refundPolicy =[
            [
                'description' => 'আমাদের সার্ভিস সম্পর্কিত যেকোনো সেবা পেতে কল করুন 01575194961 // 01987051493
Premium Panjabi Collection || New Panjabi collection Eid 2024 || Bangomart B-0732422
trending and new stylish panjabi collection for eid 2024 is now available on bangomart.',
            ],
        ];

       RefundPolicy::insert($refundPolicy);
    }
}
