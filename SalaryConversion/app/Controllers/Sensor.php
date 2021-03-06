<?php

namespace App\Controllers;

use App\Models\sensorModel;
use PDO;
use phpDocumentor\Reflection\PseudoTypes\False_;
use PhpParser\Node\Expr\Cast\Array_;

class Sensor extends BaseController
{
    protected $sensorModel;
    protected $sensor_data;
    protected $data_room1;
    protected $data_room2;
    protected $data_room3;

    protected $room1_temp;
    protected $room1_hum;
    protected $room2_temp;
    protected $room2_hum;
    protected $room3_temp;
    protected $room3_hum;

    protected $flag;

    protected $sensing_data;

    public function __construct()
    {
        $this->sensorModel = new sensorModel();
        $this->sensing_data = [];
        $this->flag = 0;
        $this->sensor_data = json_decode(file_get_contents('../public/json/sensor_data.json'), true);
        $this->convert_data($this->sensor_data);
    }

    public function index()
    {
        $data = [
            'title' => 'Sensor Aggregation',
            'room1_temp' => $this->room1_temp,
            'room2_temp' => $this->room2_temp,
            'room3_temp' => $this->room3_temp,
            'room1_hum' => $this->room1_hum,
            'room2_hum' => $this->room2_hum,
            'room3_hum' => $this->room3_hum,
            'data_room1' => $this->data_room1,
            'data_room2' => $this->data_room2,
            'data_room3' => $this->data_room3,
            'flag' => $this->flag,
            'click' => 0
        ];

        return view('pages/sensor_agre', $data);
    }

    public function convert_data($data)
    {
        $this->room1_hum = [];
        $this->room1_temp = [];
        $this->room2_hum = [];
        $this->room2_temp = [];
        $this->room3_hum = [];
        $this->room3_temp = [];

        $this->data_room1 = [];
        $this->data_room2 = [];
        $this->data_room3 = [];

        if ($this->flag == 0) {
            foreach ($data as $row) {
                foreach ($row as $r) {
                    if ($r['roomArea'] === 'roomArea1') {
                        $arrInsert = [
                            "id" => $r['id'],
                            "temperature" => $r['temperature'],
                            "humidity" => $r['humidity'],
                            "roomArea" => $r['roomArea'],
                            "timeStamp" => $r['timestamp'],
                        ];
                        array_push($this->data_room1, $arrInsert);
                    }
                    if ($r['roomArea'] === 'roomArea2') {
                        $arrInsert = [
                            "id" => $r['id'],
                            "temperature" => $r['temperature'],
                            "humidity" => $r['humidity'],
                            "roomArea" => $r['roomArea'],
                            "timeStamp" => $r['timestamp'],
                        ];
                        array_push($this->data_room2, $arrInsert);
                    }
                    if ($r['roomArea'] === 'roomArea3') {
                        $arrInsert = [
                            "id" => $r['id'],
                            "temperature" => $r['temperature'],
                            "humidity" => $r['humidity'],
                            "roomArea" => $r['roomArea'],
                            "timeStamp" => $r['timestamp'],
                        ];
                        array_push($this->data_room3, $arrInsert);
                    }
                }
            }
        } else {
            foreach ($data as $r) {
                if ($r['roomArea'] === 'roomArea1') {
                    $arrInsert = [
                        "id" => $r['id'],
                        "temperature" => $r['temperature'],
                        "humidity" => $r['humidity'],
                        "roomArea" => $r['roomArea'],
                        "timeStamp" => $r['timestamp'],
                    ];
                    array_push($this->data_room1, $arrInsert);
                }
                if ($r['roomArea'] === 'roomArea2') {
                    $arrInsert = [
                        "id" => $r['id'],
                        "temperature" => $r['temperature'],
                        "humidity" => $r['humidity'],
                        "roomArea" => $r['roomArea'],
                        "timeStamp" => $r['timestamp'],
                    ];
                    array_push($this->data_room2, $arrInsert);
                }
                if ($r['roomArea'] === 'roomArea3') {
                    $arrInsert = [
                        "id" => $r['id'],
                        "temperature" => $r['temperature'],
                        "humidity" => $r['humidity'],
                        "roomArea" => $r['roomArea'],
                        "timeStamp" => $r['timestamp'],
                    ];
                    array_push($this->data_room3, $arrInsert);
                }
            }
        }


        // data min, max, med, av for room1
        $min_room1_temp = min(array_column($this->data_room1, 'temperature'));
        $max_room1_temp = max(array_column($this->data_room1, 'temperature'));;
        $av_room1_temp = 0;
        $med_room1_temp = 0;

        // data min, max, med, av for room2
        $min_room2_temp = min(array_column($this->data_room2, 'temperature'));;
        $max_room2_temp = max(array_column($this->data_room2, 'temperature'));;
        $av_room2_temp = 0;
        $med_room2_temp = 0;

        // data min, max, med, av for room3
        $min_room3_temp = min(array_column($this->data_room3, 'temperature'));;
        $max_room3_temp = max(array_column($this->data_room3, 'temperature'));;
        $av_room3_temp = 0;
        $med_room3_temp = 0;

        // data min, max, med, av for room1
        $min_room1_hum = min(array_column($this->data_room1, 'humidity'));
        $max_room1_hum = max(array_column($this->data_room1, 'humidity'));;
        $av_room1_hum = 0;
        $med_room1_hum = 0;

        // data min, max, med, av for room2
        $min_room2_hum = min(array_column($this->data_room2, 'humidity'));;
        $max_room2_hum = max(array_column($this->data_room2, 'humidity'));;
        $av_room2_hum = 0;
        $med_room2_hum = 0;

        // data min, max, med, av for room3
        $min_room3_hum = min(array_column($this->data_room3, 'humidity'));;
        $max_room3_hum = max(array_column($this->data_room3, 'humidity'));;
        $av_room3_hum = 0;
        $med_room3_hum = 0;

        if ($this->data_room1) {
            $count = count($this->data_room1);
            $mid = floor(($count - 1) / 2);
            if ($count % 2) {
                $med_room1_temp = $this->data_room1[$mid]['temperature'];
                $med_room1_hum = $this->data_room1[$mid]['humidity'];
            } else {
                $low_1 = $this->data_room1[$mid]['temperature'];
                $high_1 = $this->data_room1[$mid + 1]['temperature'];
                $med_room1_temp = (($low_1 + $high_1) / 2);

                $low_2 = $this->data_room1[$mid]['humidity'];
                $high_2 = $this->data_room1[$mid + 1]['humidity'];
                $med_room1_hum = (($low_2 + $high_2) / 2);
            }

            $total_hum = 0;
            $total_temp = 0;
            foreach ($this->data_room1 as $room1) {
                $total_temp = $total_temp + $room1['temperature'];
                $total_hum = $total_hum + $room1['humidity'];
            }
            $av_room1_temp = ($total_temp / $count);
            $av_room1_hum = ($total_hum / $count);
        }

        if ($this->data_room2) {
            $count = count($this->data_room2);
            $mid = floor(($count - 1) / 2);
            if ($count % 2) {
                $med_room2_temp = $this->data_room2[$mid]['temperature'];
                $med_room2_hum = $this->data_room2[$mid]['humidity'];
            } else {
                $low_1 = $this->data_room2[$mid]['temperature'];
                $high_1 = $this->data_room2[$mid + 1]['temperature'];
                $med_room2_temp = (($low_1 + $high_1) / 2);

                $low_2 = $this->data_room2[$mid]['humidity'];
                $high_2 = $this->data_room2[$mid + 1]['humidity'];
                $med_room2_hum = (($low_2 + $high_2) / 2);
            }

            $total_hum = 0;
            $total_temp = 0;
            foreach ($this->data_room2 as $room2) {
                $total_temp = $total_temp + $room2['temperature'];
                $total_hum = $total_hum + $room2['humidity'];
            }
            $av_room2_temp = ($total_temp / $count);
            $av_room2_hum = ($total_hum / $count);
        }

        if ($this->data_room3) {
            $count = count($this->data_room3);
            $mid = floor(($count - 1) / 2);
            if ($count % 2) {
                $med_room3_temp = $this->data_room3[$mid]['temperature'];
                $med_room3_hum = $this->data_room3[$mid]['humidity'];
            } else {
                $low_1 = $this->data_room3[$mid]['temperature'];
                $high_1 = $this->data_room3[$mid + 1]['temperature'];
                $med_room3_temp = (($low_1 + $high_1) / 2);

                $low_2 = $this->data_room3[$mid]['humidity'];
                $high_2 = $this->data_room3[$mid + 1]['humidity'];
                $med_room3_hum = (($low_2 + $high_2) / 2);
            }

            $total_hum = 0;
            $total_temp = 0;
            foreach ($this->data_room3 as $room1) {
                $total_temp = $total_temp + $room1['temperature'];
                $total_hum = $total_hum + $room1['humidity'];
            }
            $av_room3_temp = ($total_temp / $count);
            $av_room3_hum = ($total_hum / $count);
        }

        $this->room1_temp = [];
        $this->room2_temp = [];
        $this->room3_temp = [];
        array_push($this->room1_temp, $min_room1_temp, $max_room1_temp, $med_room1_temp, $av_room1_temp);
        array_push($this->room2_temp, $min_room2_temp, $max_room2_temp, $med_room2_temp, $av_room2_temp);
        array_push($this->room3_temp, $min_room3_temp, $max_room3_temp, $med_room3_temp, $av_room3_temp);

        $this->room1_hum = [];
        $this->room2_hum = [];
        $this->room3_hum = [];
        array_push($this->room1_hum, $min_room1_hum, $max_room1_hum, $med_room1_hum, $av_room1_hum);
        array_push($this->room2_hum, $min_room2_hum, $max_room2_hum, $med_room2_hum, $av_room2_hum);
        array_push($this->room3_hum, $min_room3_hum, $max_room3_hum, $med_room3_hum, $av_room3_hum);
    }

    public function Sensing($click)
    {
        $this->flag = 1;

        if ($click) {
            $i = 0;
            while ($i < 100) {
                $this->start_sense();
                $i++;
                if (!$click) {
                    break;
                }
            }

            $json_res = json_encode($this->sensing_data);
            file_put_contents("../public/json/New_SensingData.json", $json_res);

            $this->convert_data($this->sensing_data);
        }

        $data = [
            'title' => 'Sensor Aggregation Simulation',
            'room1_temp' => $this->room1_temp,
            'room2_temp' => $this->room2_temp,
            'room3_temp' => $this->room3_temp,
            'room1_hum' => $this->room1_hum,
            'room2_hum' => $this->room2_hum,
            'room3_hum' => $this->room3_hum,
            'data_room1' => $this->data_room1,
            'data_room2' => $this->data_room2,
            'data_room3' => $this->data_room3,
            'flag' => $this->flag,
            'click' => $click
        ];
        return view('pages/sensor_agre', $data);
    }

    public function start_sense()
    {
        $room = ['roomArea1', 'roomArea2', 'roomArea3'];
        $temp_json = [];

        $temp_id = rand(140, 500);
        $temp_temperature = rand(15, 30);
        $temp_humidity = rand(15, 30);
        $temp_timestamp = mt_rand(1262055681, 1262055681);
        $idx = rand(0, 2);
        $temp_room = $room[$idx];

        $temp_json = [
            'id' => $temp_id,
            'temperature' => $temp_temperature,
            'humidity' => $temp_humidity,
            'roomArea' => $temp_room,
            'timestamp' => $temp_timestamp
        ];

        // array_push($temp_json, $temp_json);

        array_push($this->sensing_data, $temp_json);
    }
}
