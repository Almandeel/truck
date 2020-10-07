<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Order </title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
    <style>
        body {
            direction: rtl;
            font-family: 'Cairo', sans-serif;
        }

        h1 {
            text-align: center;
            line-height: 3;
        }

        .table {
            width: 100%;
            max-width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #eceeef;
            text-align: center !important;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #eceeef;
        }

        .table tbody {
            border-top: 2px solid #ddd;
        }

        .table-sm th,
        .table-sm td {
            padding: 0.3rem;
        }

        .table-bordered {
            border: 1px solid #ddd;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #ddd;
        }

        .table-bordered thead th,
        .table-bordered thead td {
            border-bottom-width: 2px;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.075);
        }

        .table-active,
        .table-active>th,
        .table-active>td {
            background-color: rgba(0, 0, 0, 0.075);
        }

        .table-hover .table-active:hover {
            background-color: rgba(0, 0, 0, 0.075);
        }

        .table-hover .table-active:hover>td,
        .table-hover .table-active:hover>th {
            background-color: rgba(0, 0, 0, 0.075);
        }

        .table-success,
        .table-success>th,
        .table-success>td {
            background-color: #dff0d8;
        }

        .table-hover .table-success:hover {
            background-color: #d0e9c6;
        }

        .table-hover .table-success:hover>td,
        .table-hover .table-success:hover>th {
            background-color: #d0e9c6;
        }

        .table-info,
        .table-info>th,
        .table-info>td {
            background-color: #d9edf7;
        }

        .table-hover .table-info:hover {
            background-color: #c4e3f3;
        }

        .table-hover .table-info:hover>td,
        .table-hover .table-info:hover>th {
            background-color: #c4e3f3;
        }

        .table-warning,
        .table-warning>th,
        .table-warning>td {
            background-color: #fcf8e3;
        }

        .table-hover .table-warning:hover {
            background-color: #faf2cc;
        }

        .table-hover .table-warning:hover>td,
        .table-hover .table-warning:hover>th {
            background-color: #faf2cc;
        }

        .table-danger,
        .table-danger>th,
        .table-danger>td {
            background-color: #f2dede;
        }

        .table-hover .table-danger:hover {
            background-color: #ebcccc;
        }

        .table-hover .table-danger:hover>td,
        .table-hover .table-danger:hover>th {
            background-color: #ebcccc;
        }

        .thead-inverse th {
            color: #fff;
            background-color: #292b2c;
        }

        .thead-default th {
            color: #464a4c;
            background-color: #eceeef;
        }

        .table-inverse {
            color: #fff;
            background-color: #292b2c;
        }

        .table-inverse th,
        .table-inverse td,
        .table-inverse thead th {
            border-color: #fff;

        }

        .table-inverse.table-bordered {
            border: 0;
        }

        .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto;
            -ms-overflow-style: -ms-autohiding-scrollbar;
        }

        .table-responsive.table-bordered {
            border: 0;
        }

        .row {
            margin-left: -15px;
            margin-right: -15px;
        }

        .col-md-6 {
            float: right;
            width: 50%;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .col-md-4 {
            width: 33.33333333%;
            float: right;
        }

    </style>
</head>

<body>
    <table style="margin-bottom: 20%">
        <thead>
            <tr>
                <th colspan="4"></th>
            </tr>
        </thead>
    </table>
    <table style="margin-top:10% !important; margin-bottom:3%" class="table table-bordered table-hover text-center bm-4">
        <thead>
            <tr>
                <th colspan="4">بيانات الطلب</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>العميل</th>
                <td>{{ $order->name }}</td>
                <th>رقم الهاتف</th>
                <td>{{ $order->phone }}</td>
            </tr>
            <tr>
                <th>نوع الشحن</th>
                <td>{{ $order->type }}</td>
                <th>تاريخ الاضافة</th>
                <td>{{ $order->created_at->format('Y-m-d H:I') }}</td>
            </tr>
            <tr>
                <th>منطقة الشحن</th>
                <td>{{ $order->from }}</td>
                <th>منطقة التفريغ</th>
                <td>{{ $order->to }}</td>
            </tr>
            <tr>
                <th>شركة الشحن</th>
                <td>{{ $order->company->name ?? '' }}</td>
                <th>رقم هاتف الشركة</th>
                <td>{{ $order->company->phone ?? '' }}</td>
            </tr>
            <tr>
                <th>تاريخ الموافقة</th>
                <td>{{ $order->accepted_at }}</td>
                <th>تاريخ التوصيل</th>
                <td>{{ $order->received_at }}</td>
            </tr>
        </tbody>
    </table>

    <table class="table table-bordered table-hover text-center">
        <thead>
            <tr>
                <th colspan="4">تفاصيل الطلب</th>
            </tr>
            <tr>
                <th>#</th>
                <th>النوع</th>
                <th>العدد</th>
                <th>الوزن</th>
            </tr>
        </thead>
        @foreach($order->items as $index=>$item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->type }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->weight }}</td>
            </tr>
        @endforeach
    </table>
</body>

</html>
