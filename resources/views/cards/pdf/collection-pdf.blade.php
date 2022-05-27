<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Transaction Receipt</title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            font-size: 16px;
            line-height: 24px;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td{
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .rtl table {
            text-align: right;
        }

        .rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>

<body>

<div class="invoice-box">
    <table>
        <tr>
            <td colspan="2" class="title" width="50%">
                <img src="{{ url('/images/ui_logo.png') }}" style="width:40%;">
            </td>
            <td width="50%">
                <b>Card Type:</b> {{ $card->cardType->name }}<br>
                <b>Card ID Number:</b> {{ $card->cardProperty->identity_no }}<br>
                <b>Card Status:</b> {{ $card->cardProperty->status }}<br>
                <b>Downloaded:</b> {{ \Carbon\Carbon::now()->format('d/m/y') }}<br>
            </td>
        </tr>
    </table>
    <br>
    <br>
    <table>
        <tr>
            <td width="50%">
                <b>Full Name:</b> {{ get_user_full_name() }}.<br>
                <b>Identity Number:</b> {{ get_user_identity_no() }}<br>
            </td>
            <td width="50%">
                <b>Faculty:</b> {{ user_faculty_name() }}.<br>
                <b>Department:</b> {{ user_department_name() }}
            </td>
        </tr>
    </table>
    <br>
    <br>
    <table>
        <tr>
            <td width="100%">
                "Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?"
            </td>
        </tr>
        <tr>
            <td width="100%">
                <p>Signed,</p>
                <b>ITEMS Director:</b> Adams Paul
            </td>
        </tr>
    </table>
</div>
</body>
</html>
