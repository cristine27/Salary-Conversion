<?php

namespace App\Controllers;

use CodeIgniter\CLI\Console;
use PhpParser\Node\Expr\Cast\Array_;

class Salary extends BaseController
{
    public function index()
    {
        // get idr to usd concuracy
        $apikey = '5516ea203aab5dbbd348';
        $query =  "IDR_USD";

        // change to the free URL if you're using the free version
        $json = file_get_contents("https://free.currconv.com/api/v7/convert?q={$query}&compact=ultra&apiKey={$apikey}");
        $obj = json_decode($json, true);
        $val = floatval($obj["$query"]);

        $url = "http://jsonplaceholder.typicode.com/users";
        $get_url = file_get_contents($url);

        $data_users = json_decode($get_url, true);
        $salary_data = json_decode(file_get_contents('../public/json/salary_data.json'), true);
        $summary = array();
        foreach ($data_users as $d) {
            $temp['id'] = $d['id'];
            $temp['name'] = $d['name'];
            $temp['username'] = $d['username'];
            $temp['email'] = $d['email'];
            $temp['address'] = $d['address']['street'] . " " . $d['address']['suite'] . " " . $d['address']['city'] . " " . $d['address']['zipcode'];
            $temp['phone'] = $d['phone'];
            $idx = 0;
            foreach ($salary_data as $s) {
                if ($d['id'] == $s[$idx]['id']) {
                    $temp['salaryIDR'] = $s[$idx]['salaryInIDR'];
                    $temp['salaryUSD'] = (int)$s[$idx]['salaryInIDR'] * $val;
                }
                $idx++;
            }
            array_push($summary, $temp);
        }

        $data = [
            'title' => 'Salary Conversion',
            'dataUser' => $summary,
        ];
        return view('pages/salary_page', $data);
    }

    public function convertCurrency($from_currency, $to_currency)
    {
    }

    //uncomment to test
    //echo convertCurrency(10, 'USD', 'PHP');
}
