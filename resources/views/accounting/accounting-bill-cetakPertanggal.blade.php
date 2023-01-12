<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pembelian</title>

    <style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }

    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }

    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }

    .invoice-box table tr td:nth-child(2) {
        text-align: right;
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
    @php
    {{
        $tanggal = date("Y-m-d");
    }}
    @endphp
    <center>
    <h2>Laporan Pembelian Bahan</h2>
    </center>       
    <label>Dibuat: {{$tanggal}}</label>  
        <table cellpadding="0" cellspacing="0" id="myTable">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="{{ asset('backend/img/logo-es.png') }}" alt="" width="150px">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                PT. N'Ice Cream<br>
                                Kec. Ngoro Kab. Mojokerto, Jawa Timur<br>
                                Gadon, Kutogirang, 61385
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td width="10%">
                    Reference
                </td>
                <td width="11%">
                    Nama Vendor
                </td>
                <td width="10%">
                    Tanggal
                </td>
                <td width="10%">
                    Total
                </td>
                <td width="10%">
                    Metode Pembayaran
                </td>
            </tr>

            @if($rfq->count())
            @foreach($rfq as $item)
            <tr class="item">
                <td>{{$item->kode_rfq}}</td>
                <td>{{$item->nama}}</td>
                <td>{{$item->tanggal_order}}</td>
                <td>Rp. {{$item->total_harga}}</td>
                <td>{{$item->metode_pembayaran == 1 ? 'Cash' : 'Transfer'}}</td>
            </tr>
            @endforeach
            @endif
        </table>
    </div>
    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>
