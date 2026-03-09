<!DOCTYPE html>
<html>
<head>
    <title>Your Ticket</title>

    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
        }

        body {
            background: url("{{ public_path('/images/petsummitpassnoqr.png') }}") no-repeat center center;
            background-size: cover;
            position: relative;
        }

        .client-name {
            position: absolute;
            top: 55%;
            left: 36%;
            font-size: 18px;
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-weight: bold;
            color: red;
        }

        .qr-code {
            position: absolute;
            bottom: 46%;
            right: 3%;
        }

        .qr-code img {
            width: 100%;
        }

    </style>

</head>

<body>

<div class="client-name">
    Ref. No.: {{ $summit->control_number }}
</div>

<div class="qr-code">
    {!! $bar_code !!}
</div>

</body>
</html>