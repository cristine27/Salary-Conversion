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

        // data min, max, med, av for room1
        $min_room1_temp = min(array_column($data_room1, 'temperature'));
        $max_room1_temp = max(array_column($data_room1, 'temperature'));;
        $av_room1_temp = 0;
        $med_room1_temp = 0;

        // data min, max, med, av for room2
        $min_room2_temp = min(array_column($data_room2, 'temperature'));;
        $max_room2_temp = max(array_column($data_room2, 'temperature'));;
        $av_room2_temp = 0;
        $med_room2_temp = 0;

        // data min, max, med, av for room3
        $min_room3_temp = min(array_column($data_room3, 'temperature'));;
        $max_room3_temp = max(array_column($data_room3, 'temperature'));;
        $av_room3_temp = 0;
        $med_room3_temp = 0;

        // data min, max, med, av for room1
        $min_room1_hum = min(array_column($data_room1, 'humidity'));
        $max_room1_hum = max(array_column($data_room1, 'humidity'));;
        $av_room1_hum = 0;
        $med_room1_hum = 0;

        // data min, max, med, av for room2
        $min_room2_hum = min(array_column($data_room2, 'humidity'));;
        $max_room2_hum = max(array_column($data_room2, 'humidity'));;
        $av_room2_hum = 0;
        $med_room2_hum = 0;

        // data min, max, med, av for room3
        $min_room3_hum = min(array_column($data_room3, 'humidity'));;
        $max_room3_hum = max(array_column($data_room3, 'humidity'));;
        $av_room3_hum = 0;
        $med_room3_hum = 0;

        if ($data_room1) {
            $count = count($data_room1);
            $mid = floor(($count - 1) / 2);
            if ($count % 2) {
                $med_room1_temp = $data_room1[$mid]['temperature'];
                $med_room1_hum = $data_room1[$mid]['humidity'];
            } else {
                $low_1 = $data_room1[$mid]['temperature'];
                $high_1 = $data_room1[$mid + 1]['temperature'];
                $med_room1_temp = (($low_1 + $high_1) / 2);

                $low_2 = $data_room1[$mid]['humidity'];
                $high_2 = $data_room1[$mid + 1]['humidity'];
                $med_room1_hum = (($low_2 + $high_2) / 2);
            }

            $total_hum = 0;
            $total_temp = 0;
            foreach ($data_room1 as $room1) {
                $total_temp = $total_temp + $room1['temperature'];
                $total_hum = $total_hum + $room1['humidity'];
            }
            $av_room1_temp = ($total_temp / $count);
            $av_room1_hum = ($total_hum / $count);
        }

        if ($data_room2) {
            $count = count($data_room2);
            $mid = floor(($count - 1) / 2);
            if ($count % 2) {
                $med_room2_temp = $data_room2[$mid]['temperature'];
                $med_room2_hum = $data_room2[$mid]['humidity'];
            } else {
                $low_1 = $data_room2[$mid]['temperature'];
                $high_1 = $data_room2[$mid + 1]['temperature'];
                $med_room2_temp = (($low_1 + $high_1) / 2);

                $low_2 = $data_room2[$mid]['humidity'];
                $high_2 = $data_room2[$mid + 1]['humidity'];
                $med_room2_hum = (($low_2 + $high_2) / 2);
            }

            $total_hum = 0;
            $total_temp = 0;
            foreach ($data_room2 as $room2) {
                $total_temp = $total_temp + $room2['temperature'];
                $total_hum = $total_hum + $room2['humidity'];
            }
            $av_room2_temp = ($total_temp / $count);
            $av_room2_hum = ($total_hum / $count);
        }

        if ($data_room3) {
            $count = count($data_room3);
            $mid = floor(($count - 1) / 2);
            if ($count % 2) {
                $med_room3_temp = $data_room3[$mid]['temperature'];
                $med_room3_hum = $data_room3[$mid]['humidity'];
            } else {
                $low_1 = $data_room3[$mid]['temperature'];
                $high_1 = $data_room3[$mid + 1]['temperature'];
                $med_room3_temp = (($low_1 + $high_1) / 2);

                $low_2 = $data_room3[$mid]['humidity'];
                $high_2 = $data_room3[$mid + 1]['humidity'];
                $med_room3_hum = (($low_2 + $high_2) / 2);
            }

            $total_hum = 0;
            $total_temp = 0;
            foreach ($data_room3 as $room1) {
                $total_temp = $total_temp + $room1['temperature'];
                $total_hum = $total_hum + $room1['humidity'];
            }
            $av_room3_temp = ($total_temp / $count);
            $av_room3_hum = ($total_hum / $count);
        }

        $room1_temp = [];
        $room2_temp = [];
        $room3_temp = [];
        array_push($room1_temp, $min_room1_temp, $max_room1_temp, $med_room1_temp, $av_room1_temp);
        array_push($room2_temp, $min_room2_temp, $max_room2_temp, $med_room2_temp, $av_room2_temp);
        array_push($room3_temp, $min_room3_temp, $max_room3_temp, $med_room3_temp, $av_room3_temp);

        $room1_hum = [];
        $room2_hum = [];
        $room3_hum = [];
        array_push($room1_hum, $min_room1_hum, $max_room1_hum, $med_room1_hum, $av_room1_hum);
        array_push($room2_hum, $min_room2_hum, $max_room2_hum, $med_room2_hum, $av_room2_hum);
        array_push($room3_hum, $min_room3_hum, $max_room3_hum, $med_room3_hum, $av_room3_hum);


        $data = [
            'title' => 'Sensor Aggregation',
            'room1_temp' => $room1_temp,
            'room2_temp' => $room2_temp,
            'room3_temp' => $room3_temp,
            'room1_hum' => $room1_hum,
            'room2_hum' => $room2_hum,
            'room3_hum' => $room3_hum,
            'data_room1' => $data_room1,
            'data_room2' => $data_room2,
            'data_room3' => $data_room3
        ];
        return view('pages/sensor_agre', $data);
    }
}
