<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h1>Sensor Aggregation</h1>
            <?php for ($i = 0; $i < 3; $i++) { ?>
                <?php
                $data_temp = [];
                $id_temp = "";
                if ($i == 0) {
                    $data_temp = $room1_temp;
                    $id_temp = "temperatur1";
                } else if ($i == 2) {
                    $data_temp = $room2_temp;
                    $id_temp = "temperatur2";
                } else {
                    $data_temp = $room3_temp;
                    $id_temp = "temperatur3";
                }
                $data_hum = [];
                $id_hum = "";
                if ($i == 0) {
                    $data_hum = $room1_hum;
                    $id_hum = "humidity1";
                } else if ($i == 2) {
                    $data_hum = $room2_hum;
                    $id_hum = "humidity2";
                } else {
                    $data_hum = $room3_hum;
                    $id_hum = "humidity3";
                }
                ?>
                <div class="container-white">
                    <div class="row-g">
                        <div class="col-g">
                            <h2 class="title-stat">Room-<?= $i + 1; ?></h2>
                        </div>
                    </div>
                    <div class="row-g p-5">
                        <div class="col-g">
                            <div class="container-white">
                                <h2>Temperatur</h2>
                                <canvas id="<?= $id_temp; ?>" width="400" height="400"></canvas>
                            </div>
                            <div class="container m-2 p-2">
                                <div class="d-inline mr-4 p-2 bg-dark text-white"><?= number_format($data_temp[0]); ?></div>
                                <div class="d-inline mr-4 p-2 bg-dark text-white"><?= number_format($data_temp[1]); ?></div>
                                <div class="d-inline mr-4 p-2 bg-dark text-white"><?= number_format($data_temp[2]); ?></div>
                                <div class="d-inline mr-4 p-2 bg-dark text-white"><?= number_format($data_temp[3]); ?></div>
                            </div>
                            <div class="container m-2 p-2">
                                <div class="d-inline p-2 bg-primary text-white">MIN</div>
                                <div class="d-inline p-2 bg-primary text-white">MAX</div>
                                <div class="d-inline p-2 bg-primary text-white">MEDIAN</div>
                                <div class="d-inline p-2 bg-primary text-white">AVERAGE</div>
                            </div>
                        </div>
                        <div class="col-g">
                            <div class="container-white">
                                <h2>Humidity</h2>
                                <canvas id="<?= $id_hum; ?>" width="400" height="400"></canvas>
                            </div>

                            <div class="container m-2 p-2">
                                <div class="d-inline mr-4 p-2 bg-dark text-white"><?= number_format($data_hum[0]); ?></div>
                                <div class="d-inline mr-4 p-2 bg-dark text-white"><?= number_format($data_hum[1]); ?></div>
                                <div class="d-inline mr-4 p-2 bg-dark text-white"><?= number_format($data_hum[2]); ?></div>
                                <div class="d-inline mr-4 p-2 bg-dark text-white"><?= number_format($data_hum[3]); ?></div>
                            </div>
                            <div class="container m-2 p-2">
                                <div class="d-inline p-2 bg-primary text-white">MIN</div>
                                <div class="d-inline p-2 bg-primary text-white">MAX</div>
                                <div class="d-inline p-2 bg-primary text-white">MEDIAN</div>
                                <div class="d-inline p-2 bg-primary text-white">AVERAGE</div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script src="<?= base_url('chartjs/Chart.bundle.min.js') ?>"></script>
<script src="<?= base_url('chartjs/Chart.bundle.min.js') ?>"></script>

<script>
    // GET CANVAS ID
    var temperatur1 = document.getElementById('temperatur1');
    var humidity1 = document.getElementById('humidity1');

    var temperatur2 = document.getElementById('temperatur2');
    var humidity2 = document.getElementById('humidity2');

    var temperatur3 = document.getElementById('temperatur3');
    var humidity3 = document.getElementById('humidity3');

    // PARSE DATA
    var data_temperatur1 = [];
    var data_humidity1 = [];
    var label_waktu1 = [];
    <?php foreach ($data_room1 as $value) : ?>
        data_temperatur1.push(<?= $value['temperature'] ?>)
        data_humidity1.push(<?= $value['humidity']; ?>)
        label_waktu1.push(<?= $value['timeStamp']; ?>)
    <?php endforeach ?>

    var data_temperatur2 = [];
    var data_humidity2 = [];
    var label_waktu2 = [];
    <?php foreach ($data_room2 as $value) : ?>
        data_temperatur2.push(<?= $value['temperature'] ?>)
        data_humidity2.push(<?= $value['humidity']; ?>)
        label_waktu2.push(<?= $value['timeStamp']; ?>)
    <?php endforeach ?>

    var data_temperatur3 = [];
    var data_humidity3 = [];
    var label_waktu3 = [];
    <?php foreach ($data_room3 as $value) : ?>
        data_temperatur3.push(<?= $value['temperature'] ?>)
        data_humidity3.push(<?= $value['humidity']; ?>)
        label_waktu3.push(<?= $value['timeStamp']; ?>)
    <?php endforeach ?>

    // DATA
    // ROOM1
    var temp_room1 = {
        datasets: [{
            data: data_temperatur1,
            backgroundColor: [
                'rgba(255,99,132,0,8)',
                'rgba(54,162,235,0,8)',
                'rgba(255,99,132,0,8)',
            ],
        }],
        labels: label_waktu1,
    }

    var hum_room1 = {
        datasets: [{
            data: data_humidity1,
            backgroundColor: [
                'rgba(255,99,132,0,8)',
                'rgba(54,162,235,0,8)',
                'rgba(255,99,132,0,8)',
            ],
        }],
        labels: label_waktu1,
    }
    //  ROOM2
    var temp_room2 = {
        datasets: [{
            data: data_temperatur2,
            backgroundColor: [
                'rgba(255,99,132,0,8)',
                'rgba(54,162,235,0,8)',
                'rgba(255,99,132,0,8)',
            ],
        }],
        labels: label_waktu2,
    }

    var hum_room2 = {
        datasets: [{
            data: data_humidity2,
            backgroundColor: [
                'rgba(255,99,132,0,8)',
                'rgba(54,162,235,0,8)',
                'rgba(255,99,132,0,8)',
            ],
        }],
        labels: label_waktu2,
    }
    // ROOM3
    var temp_room3 = {
        datasets: [{
            data: data_temperatur3,
            backgroundColor: [
                'rgba(255,99,132,0,8)',
                'rgba(54,162,235,0,8)',
                'rgba(255,99,132,0,8)',
            ],
        }],
        labels: label_waktu3,
    }

    var hum_room3 = {
        datasets: [{
            data: data_humidity3,
            backgroundColor: [
                'rgba(255,99,132,0,8)',
                'rgba(54,162,235,0,8)',
                'rgba(255,99,132,0,8)',
            ],
        }],
        labels: label_waktu3,
    }

    // CHART
    var chart_temp_room1 = new Chart(temperatur1, {
        type: 'line',
        data: temp_room1,
    });

    var chart_hum_room1 = new Chart(humidity1, {
        type: 'line',
        data: hum_room1
    });

    var chart_temp_room2 = new Chart(temperatur2, {
        type: 'line',
        data: temp_room1
    });

    var chart_hum_room2 = new Chart(humidity2, {
        type: 'line',
        data: hum_room1
    });

    var chart_temp_room3 = new Chart(temperatur3, {
        type: 'line',
        data: temp_room1
    });

    var chart_hum_room3 = new Chart(humidity3, {
        type: 'line',
        data: hum_room1
    });
</script>
<?= $this->endSection(); ?>