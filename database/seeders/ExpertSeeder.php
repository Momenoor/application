<?php

namespace Database\Seeders;

use App\Models\Expert;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpertSeeder extends Seeder
{

    private $expert = [
        ['expertid' => '1', 'name' => 'د.رضا درويش آل رحمه', 'class' => 'accounting', 'phone' => '', 'userid' => '1', 'category' => 'main', 'active' => 'true', 'created' => NULL, 'updated' => NULL, 'deleted' => NULL],
        ['expertid' => '2', 'name' => 'محمد عطية شاهين', 'class' => 'accounting', 'phone' => '', 'userid' => '2', 'category' => 'certified', 'active' => 'true', 'created' => NULL, 'updated' => NULL, 'deleted' => NULL],
        ['expertid' => '3', 'name' => 'احمد ابراهيم', 'class' => 'accounting', 'phone' => '', 'userid' => '3', 'category' => 'certified', 'active' => 'true', 'created' => NULL, 'updated' => NULL, 'deleted' => NULL],
        ['expertid' => '4', 'name' => 'المزمل خليفة', 'class' => 'other', 'phone' => '', 'userid' => '4', 'category' => 'assistant', 'active' => 'true', 'created' => NULL, 'updated' => NULL, 'deleted' => NULL],
        ['expertid' => '5', 'name' => 'محمد مدحت عبد الرشيد', 'class' => 'accounting', 'phone' => '', 'userid' => '5', 'category' => 'assistant', 'active' => 'true', 'created' => NULL, 'updated' => NULL, 'deleted' => NULL],
        ['expertid' => '6', 'name' => 'شريف شبل ابوسمرة', 'class' => 'accounting', 'phone' => '', 'userid' => '6', 'category' => 'assistant', 'active' => 'true', 'created' => NULL, 'updated' => NULL, 'deleted' => NULL],
        ['expertid' => '7', 'name' => 'مؤمن ابراهيم نور', 'class' => 'accounting', 'phone' => '', 'userid' => '7', 'category' => 'assistant', 'active' => 'true', 'created' => NULL, 'updated' => NULL, 'deleted' => NULL],
        ['expertid' => '8', 'name' => 'اسلام اصلان', 'class' => 'other', 'phone' => '', 'userid' => '8', 'category' => 'assistant', 'active' => 'true', 'created' => NULL, 'updated' => NULL, 'deleted' => NULL],
        ['expertid' => '10', 'name' => 'محمد بلقيس', 'class' => 'engineering', 'phone' => '', 'userid' => '', 'category' => 'assistant', 'active' => 'true', 'created' => NULL, 'updated' => NULL, 'deleted' => NULL],
        ['expertid' => '12', 'name' => 'محمد خميس الباز', 'class' => 'accounting', 'phone' => '', 'userid' => '12', 'category' => 'assistant', 'active' => 'true', 'created' => NULL, 'updated' => NULL, 'deleted' => NULL],
        ['expertid' => '13', 'name' => 'أحمد محسن ', 'class' => 'accounting', 'phone' => '', 'userid' => '15', 'category' => 'assistant', 'active' => 'true', 'created' => NULL, 'updated' => NULL, 'deleted' => NULL],
        ['expertid' => '14', 'name' => 'عمرو أبو الخير', 'class' => 'accounting', 'phone' => '0544587689', 'userid' => '16', 'category' => 'assistant', 'active' => 'true', 'created' => NULL, 'updated' => NULL, 'deleted' => NULL],
        ['expertid' => '15', 'name' => 'نهلة زين العابدين', 'class' => 'accounting', 'phone' => '', 'userid' => '17', 'category' => 'assistant', 'active' => 'true', 'created' => NULL, 'updated' => NULL, 'deleted' => NULL]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect($this->expert)->each(function ($item) {
            Expert::create([
                'id' => $item['expertid'],
                'name' => $item['name'],
                'phone' => $item['phone'],
                'email' => '',
                'category' => $item['category'],
                'field' => $item['class'],
                'user_id' => is_null($item['userid'])?:1,
            ]);
        });
    }
}
