<?php

namespace App\Controllers;

use App\Models\sensorModel;
use PDO;
use phpDocumentor\Reflection\PseudoTypes\False_;
use PhpParser\Node\Expr\Cast\Array_;

class Sensor extends BaseController
{
    protected $sensorModel;

    public function __construct()
    {
        $this->sensorModel = new sensorModel();
    }
    public function index()
    {
        $sensor_data = json_decode(file_get_contents('../public/json/sensor_data.json'), true);
        $data_room1 = [];
        $data_room2 = [];
        $data_room3 = [];
        $idx = 0;

        foreach ($sensor_data as $row) {
            foreach ($row as $r) {
                if ($r['roomArea'] === 'roomArea1') {
                    $arrInsert = [
                        "id" => $r['id'],
                        "temperature" => $r['temperature'],
                        "humidity" => $r['humidity'],
                        "roomArea" => $r['roomArea'],
                        "timeStamp" => $r['timestamp'],
                    ];
                    array_push($data_room1, $arrInsert);
                }
                if ($r['roomArea'] === 'roomArea2') {
                    $arrInsert = [
                        "id" => $r['id'],
                        "temperature" => $r['temperature'],
                        "humidity" => $r['humidity'],
                        "roomArea" => $r['roomArea'],
                        "timeStamp" => $r['timestamp'],
                    ];
                    array_push($data_room2, $arrInsert);
                }
                if ($r['roomArea'] === 'roomArea3') {
                    $arrInsert = [
                        "id" => $r['id'],
                        "temperature" => $r['temperature'],
                        "humidity" => $r['humidity'],
                        "roomArea" => $r['roomArea'],
                        "timeStamp" => $r['timestamp'],
                    ];
                    array_push($data_room3, $arrInsert);
                }
                // $arrInsert = [
                //     "id" => $r['id'],
                //     "temperature" => $r['temperature'],
                //     "humidity" => $r['humidity'],
                //     "roomArea" => $r['roomArea'],
                //     "timeStamp" => $r['timestamp'],
                // ];
                // $this->sensorModel->save($arrInsert);
            }
        }
        dd($data_room1, $data_room2, $data_room3);
        $data = [
            'title' => 'Sensor Aggregation',
        ];
        return view('pages/sensor_agre', $data);
    }
}
