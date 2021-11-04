<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <div class="card" style="width: 30rem;">
                <div class="card-body">
                    <h3 class="card-title">
                        IoT Application Developer (R&D) Tech Test - Cristine
                    </h3>
                    <h6 class="card-subtitle mb-2 text-muted">
                        Choose Problem :
                    </h6>
                    <div class="container">
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-primary btn-sm d-inline p-2 mx-3" href="../Salary" role="button">Salary Conversion</a>
                            <a class="btn btn-primary btn-sm d-inline p-2 mx-3" href="../Sensor" role="button">Sensors Aggregation</a>
                            <a class="btn btn-primary btn-sm d-inline p-2 mx-3" href="../Sensor/Sensing" role="button">Sensors Aggregation Simulation</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>