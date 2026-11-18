<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IronFuel Gym Pantry</title>
    <style>
        body {
            font-family: Verdana, Arial, sans-serif;
            background: #0b0b0b;
            margin: 0;
            padding: 20px;
            color: #dddddd;
        }

        .container {
            max-width: 860px;
            margin: auto;
            background: #151515;
            border: 2px solid #c6ff00;
        }

        .banner {
            background: #000000;
            padding: 22px 30px;
            border-bottom: 4px solid #c6ff00;
        }

        .banner h1 {
            margin: 0;
            font-size: 34px;
            color: #c6ff00;
            letter-spacing: 4px;
            text-transform: uppercase;
            font-style: italic;
        }

        .banner p {
            margin: 6px 0 0;
            font-size: 11px;
            letter-spacing: 2px;
            color: #888888;
            text-transform: uppercase;
        }

        .content {
            padding: 20px 30px;
        }

        h2 {
            color: #ffffff;
            text-transform: uppercase;
            font-size: 18px;
            letter-spacing: 1px;
            border-left: 6px solid #c6ff00;
            padding-left: 10px;
            margin-top: 28px;
        }

        h3 {
            color: #c6ff00;
            font-size: 14px;
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .stats {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }

        .stat {
            flex: 1;
            background: #1f1f1f;
            border: 1px solid #333333;
            padding: 12px;
            text-align: center;
        }

        .stat b {
            display: block;
            font-size: 20px;
            color: #c6ff00;
            margin-bottom: 4px;
        }

        .stat span {
            font-size: 11px;
            text-transform: uppercase;
            color: #999999;
        }

        label {
            display: block;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #999999;
            margin-top: 10px;
        }

        input, select, button {
            width: 100%;
            padding: 10px;
            margin: 5px 0 12px;
            box-sizing: border-box;
            border: 1px solid #444444;
            font-size: 14px;
            background: #222222;
            color: #ffffff;
        }

        button {
            background: #c6ff00;
            color: #000000;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background: #ffffff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 8px 0 14px;
            font-size: 13px;
        }

        th {
            background: #c6ff00;
            color: #000000;
            font-size: 11px;
            text-transform: uppercase;
        }

        th, td {
            border: 1px solid #333333;
            padding: 7px 9px;
            text-align: left;
        }

        tr:nth-child(even) td {
            background: #1b1b1b;
        }

        hr {
            border: none;
            border-top: 1px solid #333333;
            margin: 22px 0;
        }

        .success {
            color: #c6ff00;
            font-weight: bold;
            text-transform: uppercase;
        }

        .error {
            color: #ff4d4d;
            font-weight: bold;
            text-transform: uppercase;
        }

        .low {
            color: #ffaa00;
        }

        .box {
            background: #1f1f1f;
            border: 1px dashed #c6ff00;
            padding: 10px 14px;
            margin: 10px 0;
        }

        .bar {
            background: #333333;
            height: 14px;
            margin: 6px 0;
        }

        .bar div {
            background: #c6ff00;
            height: 14px;
        }

        a {
            color: #c6ff00;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="banner">
        <h1>IronFuel</h1>
        <p>Train. Eat. Repeat. &nbsp;|&nbsp; Holy Angel University - School of Computing &nbsp;|&nbsp; PHP Control Statements</p>
    </div>
    <div class="content">
