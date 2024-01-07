<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
</head>
<body>
    <h3 class="text-center">
        Transaction Report of {{$branch->name}}
    </h3>
    <br/>
    <h5 class="text-center">
        From {{ \Carbon\Carbon::parse($beginDate)->format('F j, Y H:i:s') }} to {{ \Carbon\Carbon::parse($endDate)->format('F j, Y H:i:s') }}
    </h5>
    <table id="table-data" class="table table-bordered">
        <thead>
            <tr>
                <th>NO</th>
                <th>Handled By</th>
                <th>Transaction Type</th>
                <th>Transaction Datetime</th>
                <th>Total Price</th>
            </tr>
        </thead>
            <tbody>
                @php $no=1; $totalsurplus = 0;@endphp
                @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$transaction->userName}}</td>
                        <td>{{$transaction->type}}</td>
                        <td>{{$transaction->tanggal}}</td>
                        <td>{{ number_format($transaction->totalPrice, 2, '.', ',') }}</td>
                    </tr>
                    @php
                        if($transaction->type == 'in') $totalsurplus -= $transaction->totalPrice;
                        else $totalsurplus += $transaction->totalPrice;
                    @endphp
                @endforeach
                <tr>
                    <td class="text-center" colspan="4">Total surplus this periode</td>
                    <td>{{ number_format($totalsurplus, 2, '.', ',') }}</td>
                </tr>
            </tbody>
        </table>
    </body>
</html>