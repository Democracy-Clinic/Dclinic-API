<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Specialization;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Specialization::create([
            'title' => '',
            'title_myan' => 'အထွေထွေရောဂါကု',
            'description' => '',
            'priority' => 1
        ]);
        Specialization::create([
            'title' => '',
            'title_myan' => 'အရေးပေါ်နှင့်ထိခိုက်ဒဏ်ရာဆိုင်ရာ',
            'description' => '',
            'priority' => 2
        ]);
        Specialization::create([
            'title' => '',
            'title_myan' => 'အထူးကုသမားတော်',
            'description' => '',
            'priority' => 3
        ]);
        Specialization::create([
            'title' => '',
            'title_myan' => 'သွားဆေးဘက်ဆိုင်ရာ',
            'description' => '',
            'priority' => 4
        ]);
        Specialization::create([
            'title' => '',
            'title_myan' => 'နား၊ နှာခေါင်း၊ လည်ချောင်းဆိုင်ရာ',
            'description' => '',
            'priority' => 5
        ]);
        Specialization::create([
            'title' => '',
            'title_myan' => 'အာဟာရဆိုင်ရာ',
            'description' => '',
            'priority' => 6
        ]);
        Specialization::create([
            'title' => '',
            'title_myan' => 'သားဖွားမီးယပ်ပိုင်းဆိုင်ရာ',
            'description' => '',
            'priority' => 7
        ]);
        Specialization::create([
            'title' => '',
            'title_myan' => 'အကြောအဆစ်ပိုင်းဆိုင်ရာ',
            'description' => '',
            'priority' => 8
        ]);
        Specialization::create([
            'title' => '',
            'title_myan' => 'နှလုံးအထူးကု',
            'description' => '',
            'priority' => 9
        ]);
        Specialization::create([
            'title' => '',
            'title_myan' => 'အရေပြားအထူးကု',
            'description' => '',
            'priority' => 10
        ]);
        Specialization::create([
            'title' => '',
            'title_myan' => 'ကလေးအထူးကု',
            'description' => '',
            'priority' => 11
        ]);
        Specialization::create([
            'title' => '',
            'title_myan' => 'ခွဲစိတ်အထူးကု',
            'description' => '',
            'priority' => 12
        ]);
    }
}
