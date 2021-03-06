<?php

namespace console\models;


use common\models\geo\City;
use common\models\geo\Region;
use common\models\products\UProducts;
use frontend\models\user\Profile;
use moonland\phpexcel\Excel;
use yii\base\Model;
use yii\helpers\StringHelper;

class UploadGeo extends Model
{
    public $file;

    public function run()
    {
        $data = Excel::import($this->file, [
            'setFirstRecordAsKeys' => false,
            'setIndexSheetByName' => false,
            'getOnlySheet' => 'sheet1'
        ]);

        Profile::updateAll(['id_city' => null]);
        UProducts::deleteAll();
        City::deleteAll();
        Region::deleteAll();


        $city = false;
        $region = false;

        foreach ($data as $item)
        {
            if ($item["A"])
            {
                $region_name = explode(" ", $item["A"]);
                $region = new Region(['name' => $region_name[0]]);
                $region->save();
            }

            $city_name = StringHelper::explode($item["B"], " ");
            $city_name = $city_name[0];

            if (strpos("(", $city_name))
                $city_name = substr($city_name, strpos("(", $city_name));

            print_r($city_name);
            $city = new City([
                'id_region' => $region->id,
                'name' => $city_name
            ]);
            $city->save();

            echo $region->name." ".$city->name." \r\n";
        }
    }
}