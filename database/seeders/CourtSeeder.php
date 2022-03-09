<?php

namespace Database\Seeders;

use App\Models\Court;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourtSeeder extends Seeder
{

    private $court = array(
        array('courtid' => '1', 'name' => 'محاكم دبي', 'adress' => '', 'phone' => '', 'active' => 'true', 'created' => NULL, 'updated' => NULL, 'deleted' => NULL),
        array('courtid' => '2', 'name' => 'محكمة الشارقة', 'adress' => '', 'phone' => '', 'active' => 'true', 'created' => NULL, 'updated' => NULL, 'deleted' => NULL),
        array('courtid' => '3', 'name' => 'محكمة ابوظبي', 'adress' => '', 'phone' => '', 'active' => 'true', 'created' => NULL, 'updated' => NULL, 'deleted' => NULL),
        array('courtid' => '4', 'name' => 'محكمة العين', 'adress' => '', 'phone' => '', 'active' => 'true', 'created' => NULL, 'updated' => NULL, 'deleted' => NULL),
        array('courtid' => '5', 'name' => 'محكمة ام القوين', 'adress' => '', 'phone' => '', 'active' => 'true', 'created' => NULL, 'updated' => NULL, 'deleted' => NULL),
        array('courtid' => '6', 'name' => 'محكمة الفجيرة', 'adress' => '', 'phone' => '', 'active' => 'true', 'created' => NULL, 'updated' => NULL, 'deleted' => NULL),
        array('courtid' => '7', 'name' => 'نيابة دبي', 'adress' => '', 'phone' => '', 'active' => 'true', 'created' => NULL, 'updated' => NULL, 'deleted' => NULL),
        array('courtid' => '8', 'name' => 'نيابة استئناف دبي', 'adress' => '', 'phone' => '', 'active' => 'true', 'created' => NULL, 'updated' => NULL, 'deleted' => NULL),
        array('courtid' => '9', 'name' => 'نيابة رأس الخيمة', 'adress' => '', 'phone' => '', 'active' => 'true', 'created' => NULL, 'updated' => NULL, 'deleted' => NULL),
        array('courtid' => '10', 'name' => 'منازعات ايجارية رأس الخيمة', 'adress' => '', 'phone' => '', 'active' => 'true', 'created' => NULL, 'updated' => NULL, 'deleted' => NULL),
        array('courtid' => '11', 'name' => 'محكمة راس الخيمة', 'adress' => '', 'phone' => '', 'active' => 'true', 'created' => NULL, 'updated' => NULL, 'deleted' => NULL),
        array('courtid' => '12', 'name' => 'محكمة النقض', 'adress' => '', 'phone' => '', 'active' => 'true', 'created' => NULL, 'updated' => NULL, 'deleted' => NULL),
        array('courtid' => '13', 'name' => 'مركز دبي للتحكيم الدولي', 'adress' => '', 'phone' => '', 'active' => 'true', 'created' => NULL, 'updated' => NULL, 'deleted' => NULL),
        array('courtid' => '14', 'name' => 'مركز ابو ظبي للتحكيم الدولي', 'adress' => '', 'phone' => '', 'active' => 'true', 'created' => NULL, 'updated' => NULL, 'deleted' => NULL),
        array('courtid' => '15', 'name' => 'مركز الشارقة للتحكيم الدولي', 'adress' => '', 'phone' => '', 'active' => 'true', 'created' => NULL, 'updated' => NULL, 'deleted' => NULL),
        array('courtid' => '16', 'name' => 'مركز عجمان للتحكيم الدولي', 'adress' => '', 'phone' => '', 'active' => 'true', 'created' => NULL, 'updated' => NULL, 'deleted' => NULL),
        array('courtid' => '17', 'name' => 'محكمة عجمان', 'adress' => '', 'phone' => '', 'active' => 'true', 'created' => NULL, 'updated' => NULL, 'deleted' => NULL),
        array('courtid' => '18', 'name' => 'دبا الفجيرة', 'adress' => '', 'phone' => '', 'active' => 'true', 'created' => NULL, 'updated' => NULL, 'deleted' => NULL),
        array('courtid' => '19', 'name' => 'اخرى', 'adress' => '', 'phone' => '', 'active' => 'true', 'created' => NULL, 'updated' => NULL, 'deleted' => NULL),
        array('courtid' => '20', 'name' => 'منازعات ايجارية دبي', 'adress' => '', 'phone' => '', 'active' => 'true', 'created' => NULL, 'updated' => NULL, 'deleted' => NULL),
        array('courtid' => '21', 'name' => 'استشاري', 'adress' => '', 'phone' => '', 'active' => 'true', 'created' => NULL, 'updated' => NULL, 'deleted' => NULL),
        array('courtid' => '22', 'name' => 'منازعات ايجارية أبوظبي', 'adress' => '', 'phone' => '', 'active' => 'true', 'created' => NULL, 'updated' => NULL, 'deleted' => NULL),
        array('courtid' => '23', 'name' => 'محكمة الظفرة', 'adress' => '', 'phone' => '', 'active' => 'true', 'created' => NULL, 'updated' => NULL, 'deleted' => NULL),
        array('courtid' => '24', 'name' => 'محكمة خورفكان', 'adress' => '', 'phone' => '', 'active' => 'true', 'created' => NULL, 'updated' => NULL, 'deleted' => NULL),
        array('courtid' => '25', 'name' => 'محكمة كلباء', 'adress' => '', 'phone' => '', 'active' => 'true', 'created' => NULL, 'updated' => NULL, 'deleted' => NULL)
    );

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect($this->court)->each(function ($item) {
            Court::create([
                'name' => $item['name'],
                'address' => $item['adress'],
                'phone' => $item['phone']
            ]);
        });
    }
}
