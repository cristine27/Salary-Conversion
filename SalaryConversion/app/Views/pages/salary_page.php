<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="contaier">
    <div class="row">
        <div class="col">
            <h1 style="justify-content: center;">salary page</h1>
            <a class="btn btn-info d-inline btn-sm float-right m-3" href="/Home/">Back</a>
            <div class="containter">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">name</th>
                            <th scope="col">username</th>
                            <th scope="col">email</th>
                            <th scope="col">address</th>
                            <th scope="col">phone</th>
                            <th scope="col">salary (IDR)</th>
                            <th scope="col">salary (USD)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dataUser as $user) : ?>
                            <tr>
                                <th scope="row"><?= $user['id'] ?></th>
                                <td><?= $user['name']; ?></td>
                                <td><?= $user['username']; ?></td>
                                <td><?= $user['email']; ?></td>
                                <td><?= $user['address']; ?></td>
                                <td><?= $user['phone']; ?></td>
                                <td><?= $user['salaryIDR']; ?></td>
                                <td><?= $user['salaryUSD']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>