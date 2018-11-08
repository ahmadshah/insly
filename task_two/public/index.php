</<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Insly Insurance Calculator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 mt-5">
                <div class="card">
                        <div class="card-header">
                            <h5>Insurance Calculator</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="installments.php">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Estimated car value <span class="text-danger">*</span></label>
                                <input type="number" name="car_value" class="form-control" id="car-value" value="100">
                                <div class="invalid-feedback">Your estimated car value between 100 to 100,000 EUR</div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tax <span class="text-danger">*</span></label>
                                <input type="number" name="tax" class="form-control" id="tax" value="0">
                                <div class="invalid-feedback">Tax value between 0 to 100 %</div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Number of installments <span class="text-danger">*</span></label>
                                <select class="form-control" name="installments">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Calculate</button>
                            </form>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <script>
        $('#car-value').blur(function(e) {
            let value = $(this).val();

            if(value < 100 || value > 100000) {
                $(this).removeClass('is-valid').addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid').addClass('is-valid');
            }
        });

        $('#tax').blur(function(e) {
            let value = $(this).val();

            if(value < 0 || value > 100) {
                $(this).removeClass('is-valid').addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid').addClass('is-valid');
            }
        });
    </script>
</body>
</html>