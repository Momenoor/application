<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{

    private $user = array(
        array('userid' => '1', 'username' => 'redha', 'email' => 'redha@axisaa.ae', 'password' => '7ebd29bb070681eb564fad4a105e0ceb', 'display_name' => 'رضا درويش آل رحمه', 'commission' => '0', 'sessid' => 'b448074164d5ec693526b280a50d384288acba01', 'has_expert' => '1', 'created' => NULL, 'updated' => NULL, 'deleted' => NULL),
        array('userid' => '2', 'username' => 'm.attia', 'email' => 'mohamed.attia@axisaa.ae', 'password' => '3e34618b7ad04340f30b1a2fd14e9878', 'display_name' => 'محمد عطية شاهين', 'commission' => '1', 'sessid' => 'a094a0c870e7b2dea3caa5f728844e3f17712717', 'has_expert' => '1', 'created' => NULL, 'updated' => NULL, 'deleted' => NULL),
        array('userid' => '3', 'username' => 'ahmed', 'email' => 'ahmed.ibrahem@axisaa.ae', 'password' => 'e10adc3949ba59abbe56e057f20f883e', 'display_name' => 'أحمد ابراهيم السيد', 'commission' => '1', 'sessid' => '52f6c9afc31f30d9014397f43984c6919e484b16', 'has_expert' => '1', 'created' => NULL, 'updated' => NULL, 'deleted' => NULL),
        array('userid' => '4', 'username' => 'khalifa', 'email' => 'khalifa@axisaa.ae', 'password' => '0', 'display_name' => 'المزمل خليفة', 'commission' => '1', 'sessid' => '0', 'has_expert' => '1', 'created' => NULL, 'updated' => NULL, 'deleted' => NULL),
        array('userid' => '5', 'username' => 'Rashied', 'email' => 'muhammad.abdulrashied@axisaa.ae', 'password' => 'e10adc3949ba59abbe56e057f20f883e', 'display_name' => 'محمد مدحت عبد الرشيد', 'commission' => '1', 'sessid' => '0', 'has_expert' => '1', 'created' => NULL, 'updated' => NULL, 'deleted' => NULL),
        array('userid' => '6', 'username' => 'sherif', 'email' => 'sherif.abosamra@axisaa.ae', 'password' => '0', 'display_name' => 'شريف شبل أبو سمرة', 'commission' => '1', 'sessid' => '0', 'has_expert' => '1', 'created' => NULL, 'updated' => NULL, 'deleted' => NULL),
        array('userid' => '7', 'username' => 'Momenoor', 'email' => 'momen.noor@axisaa.ae', 'password' => 'ecebbf89e27cc7934452fb9df988d2c2', 'display_name' => 'مؤمن ابراهيم نور', 'commission' => '1', 'sessid' => '780f78fd2917ccc98ac4d8488c9e32176a6b15b5', 'has_expert' => '1', 'created' => NULL, 'updated' => NULL, 'deleted' => NULL),
        array('userid' => '8', 'username' => 'islam', 'email' => 'islam.aslan@axisaa.ae', 'password' => '0', 'display_name' => 'اسلام علاء أصلان', 'commission' => '1', 'sessid' => '0', 'has_expert' => '0', 'created' => NULL, 'updated' => NULL, 'deleted' => NULL),
        array('userid' => '9', 'username' => 'manaf', 'email' => 'manaf.ch@axisaa.ae', 'password' => '93b0bd4243f981ac2e93bce57b3beae0', 'display_name' => 'عبد المناف شيمالا', 'commission' => '1', 'sessid' => 'e41ce6c47024320956eb8f2aa1c9295efea75abf', 'has_expert' => '0', 'created' => NULL, 'updated' => NULL, 'deleted' => NULL),
        array('userid' => '11', 'username' => 'abbas', 'email' => 'ahmed.abbas@jpaemirates.com', 'password' => '', 'display_name' => 'أحمد عباس', 'commission' => '1', 'sessid' => '0', 'has_expert' => '0', 'created' => NULL, 'updated' => NULL, 'deleted' => NULL),
        array('userid' => '12', 'username' => 'mbaz', 'email' => 'm.elbaz@jpameirates.com', 'password' => 'e10adc3949ba59abbe56e057f20f883e', 'display_name' => 'محمد خميس الباز', 'commission' => '1', 'sessid' => '377ece7a7ebb005332b50ca75b07c046bc378290', 'has_expert' => '1', 'created' => NULL, 'updated' => NULL, 'deleted' => NULL),
        array('userid' => '13', 'username' => 'anas', 'email' => 'anas@jpaemirates.com', 'password' => 'e10adc3949ba59abbe56e057f20f883e', 'display_name' => 'إبراهيم البنداري', 'commission' => '1', 'sessid' => 'adacc9afdd5e6007bb9892cb53820635f2f87942', 'has_expert' => '0', 'created' => NULL, 'updated' => NULL, 'deleted' => NULL),
        array('userid' => '14', 'username' => 'Samir', 'email' => 'samir@jpaemirates.com', 'password' => 'e10adc3949ba59abbe56e057f20f883e', 'display_name' => 'سمير عماد', 'commission' => '1', 'sessid' => 'cff3392f82b486436a599aa85af5bccb504804c7', 'has_expert' => '0', 'created' => NULL, 'updated' => NULL, 'deleted' => NULL),
        array('userid' => '15', 'username' => 'a.mohsen@jpaemirates.com', 'email' => 'a.mohesn@jpaemirates.com', 'password' => 'e10adc3949ba59abbe56e057f20f883e', 'display_name' => 'Ahmed Mohsen', 'commission' => '1', 'sessid' => '487cf26a8230164b64bef02fff2179e2dda7c1c3', 'has_expert' => '1', 'created' => NULL, 'updated' => NULL, 'deleted' => NULL),
        array('userid' => '16', 'username' => 'amr.ali', 'email' => 'amr.aboelkheir@jpaemirates.com', 'password' => 'e10adc3949ba59abbe56e057f20f883e', 'display_name' => 'عمرو أبو الخير', 'commission' => '1', 'sessid' => '3dc6bb352ded0d2b3476909cd931d0526f0fa516', 'has_expert' => '1', 'created' => NULL, 'updated' => NULL, 'deleted' => NULL),
        array('userid' => '17', 'username' => 'nahla', 'email' => 'mahla.zein@jpaemirates.com', 'password' => 'e10adc3949ba59abbe56e057f20f883e', 'display_name' => 'نهلة زين العابدين', 'commission' => '1', 'sessid' => '0', 'has_expert' => '1', 'created' => NULL, 'updated' => NULL, 'deleted' => NULL)
    );

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect($this->user)->each(function ($item) {
            User::create([
                'id' => $item['userid'],
                'name' => $item['username'],
                'email' => $item['email'],
                'password' => Hash::make(123456),
                'display_name' => $item['display_name'],
            ]);
        });
    }
}
