<style type="text/css"> .dashboard-list-group {
        list-style-type: none;
        margin-bottom: 15px;
    }

    .dashboard-list-group > span {
        font-size: 1.5em;
    }</style>
<!DOCTYPE html>
<html>
<head>

    <title>SAE Desafia</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
          crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>

    <style type="text/css">
        .breadcrumb {
            display: block !important;
            text-align: right;
            padding-right: 40px;
        }

        .breadcrumb .breadcrumb-item {
            display: inline-block;
        }

    </style>
</head>
<body>
<div class="container">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><i class="fa fa-times"></i> Error <?php echo $code; ?></li>
            </ol>
        </nav>
    </div>
    <div class="offset-2 col-8">
        <div class="card">
            <div class="card-header">
                <h1 class="text-center">Error <?php echo $code; ?></h1>
            </div>
            <div class="card-body">
                <h3 class="text-center"><?php echo $message; ?></h3>
            </div>
        </div>
    </div>
</div>
</body>
</html>