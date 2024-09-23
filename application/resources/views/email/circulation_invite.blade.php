<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Circular Invitation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .email-container {
            background-color: #ffffff;
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #dddddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #007BFF;
            color: #ffffff;
            padding: 10px;
            text-align: center;
        }

        .content {
            margin: 20px 0;
        }

        .content p {
            margin: 10px 0;
        }

        .footer {
            text-align: center;
            color: #777777;
            font-size: 12px;
            margin-top: 20px;
        }

        .label {
            font-weight: bold;
            color: #333333;
        }

        .value {
            margin-left: 10px;
            color: #555555;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <h1>Circular Invitation</h1>
        </div>
        <div class="content">
            <p><span class="label">Title Name:</span> <span class="value">{{ $data->title }}</span></p>
            <p><span class="label">Deadline:</span> <span class="value">{{ $data->deadline }}</span></p>
        </div>
        <div class="footer">
            <p>Thank you.</p>
        </div>
    </div>
</body>

</html>
