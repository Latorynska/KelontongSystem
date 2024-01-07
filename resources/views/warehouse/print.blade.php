<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
</head>
<body>
    <h3 class="text-center">
        Stock Item Report of {{$branch->name}}
    </h3>
    <br/>
    <h5 class="text-center">
        Record at {{ now()->format('F j, Y H:i:s') }}
    </h5>
    <table id="table-data" class="table table-bordered">
        <thead>
            <tr>
                <th>NO</th>
                <th>Kode Barang</th>
                <th>Name</th>
                <th>Stock</th>
                <th>Price</th>
                <th>Discount</th>
            </tr>
        </thead>
            <tbody>
                @php $no=1; $totalsurplus = 0;@endphp
                @foreach ($branch->items as $item)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$item->kode_barang}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->stock}}</td>
                        <td>{{$item->price}}</td>
                        <td>{{$item->discount}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>