<?php
    require '../vendor/autoload.php';

    use Insly\Calculator\Calculator;

    $estimatedCarValue = $_POST['car_value'];
    $tax = $_POST['tax'];
    $installments = $_POST['installments'];

    $calculator = (new Calculator($estimatedCarValue, $tax, $installments))->calculate();
    $policy = $calculator->getPolicy();
    $installments = $calculator->getInstallments();
?>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Insly Insurance Calculator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row mt-5 mb-5">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mt-2 float-left">Policy</h5>
                        <a href="/" class="btn btn-primary float-right">Recalculate</a>
                    </div>
                    <div class="card-body">
                        <dl class="row">
                            <dt class="col-sm-6">Car Value</dt>
                            <dd class="col-sm-6 text-right">
                                <?php echo number_format($calculator->getCarValue(), 2); ?>
                            </dd>
                            <dt class="col-sm-6">
                                Base Premium <small>(<?php echo $calculator->getBasePrice(); ?>%)</small>
                            </dt>
                            <dd class="col-sm-6 text-right">
                                <?php echo number_format($calculator->getPolicy()->getBasePriceAmount(), 2); ?>
                            </dd>
                            <dt class="col-sm-6">
                                Commission <small>(<?php echo $calculator->getCommission(); ?>%)</small>
                            </dt>
                            <dd class="col-sm-6 text-right">
                                <?php echo number_format($calculator->getPolicy()->getCommissionAmount(), 2); ?>
                            </dd>
                            <dt class="col-sm-6">
                                Tax <small>(<?php echo $calculator->getTax(); ?>%)</small>
                            </dt>
                            <dd class="col-sm-6 text-right">
                                <?php echo number_format($calculator->getPolicy()->getTaxAmount(), 2); ?>
                            </dd>
                        </dl>
                    </div>
                    <div class="card-footer bg-dark text-white font-weight-bold">
                        <dl class="row">
                            <dt class="col-sm-6">Total Cost</dt>
                            <dd class="col-sm-6 text-right">
                                <?php echo number_format($calculator->getPolicy()->getGrandTotalAmount(), 2); ?>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 mb-3">
                <h3>Installments</h3>
            </div>
            <?php foreach($installments as $index => $installment) : ?>
                <div class="col-sm-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h6>Installment <?php echo $index+1; ?></h6>
                            <hr>
                            <dl class="row">
                                <dt class="col-sm-7">
                                    Base Premium
                                </dt>
                                <dd class="col-sm-5 text-right">
                                    <?php echo number_format($installment->getBasePriceAmount(), 2); ?>
                                </dd>
                                <dt class="col-sm-7">
                                    Commission
                                </dt>
                                <dd class="col-sm-5 text-right">
                                    <?php echo number_format($installment->getCommissionAmount(), 2); ?>
                                </dd>
                                <dt class="col-sm-7">
                                    Tax
                                </dt>
                                <dd class="col-sm-5 text-right">
                                    <?php echo number_format($installment->getTaxAmount(), 2); ?>
                                </dd>
                            </dl>
                        </div>
                        <div class="card-footer bg-dark text-white font-weight-bold">
                            <dl class="row">
                                <dt class="col-sm-6">Total Cost</dt>
                                <dd class="col-sm-6 text-right">
                                    <?php echo number_format($installment->getGrandTotalAmount(), 2); ?>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>