<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h1>Sensor Aggregation</h1>

            <div class="container-white">
                <div class="row-g">
                    <div class="col-g">
                        <h2 class="title-stat">Temperatur</h2>
                    </div>

                    <div class="col-g">
                        <h2 class="title-stat">Humidity</h2>
                    </div>
                </div>
                <div class="row-g p-5">
                    <div class="col-g">
                        <div class="container-white">
                            <h2>Temperatur</h2>
                            <canvas id="temperatur" width="400" height="400"></canvas>
                        </div>
                    </div>
                    <div class="col-g">
                        <div class="container-white">
                            <h2>Humidity</h2>
                            <canvas id="humidity" width="400" height="400"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h3>Latest Value</h3>
        <div class="container">
            <div class="d-inline p-2 bg-primary text-white">MIN</div>
            <div class="d-inline p-2 bg-dark text-white">MAX</div>
            <div class="d-inline p-2 bg-primary text-white">MEDIAN</div>
            <div class="d-inline p-2 bg-dark text-white">AVERAGE</div>
        </div>
    </div>
</div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script src="<?= base_url('chartjs/Chart.bundle.min.js') ?>"></script>
<script>
    var temperatur = document.getElementById('temperatur');
    var data_temperatur = [];
    var label_temperatur = [];
</script>
<?= $this->endSection(); ?>