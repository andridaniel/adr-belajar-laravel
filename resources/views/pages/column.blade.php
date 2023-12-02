@extends('layouts.main')

@section('konten')

<figure class="highcharts-figure">
    <div id="container"></div>
    <p class="highcharts-description m-2">
        Column and Bar Charts
    </p>
</figure>

<script>
    var category_name = <?php echo json_encode($data['category_name']); ?>;
    var total_produk = <?php echo json_encode($data['total_produk']); ?>;
    var total_harga = <?php echo json_encode($data['total_harga']); ?>;
    var total_stok = <?php echo json_encode($data['total_stok']); ?>;
    
    document.addEventListener('DOMContentLoaded', function () {
        Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Informasi Produk per Kategori',
                style: {
                    color: '#000000'
                }
            },
            xAxis: {
                categories: category_name,
                crosshair: true,
                accessibility: {
                    description: 'Categories'
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Values'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y}</b></td></tr>' +
                    '<tr><td style="color:{series.color};padding:0">Total Harga: </td>' +
                    '<td style="padding:0"><b>{point.harga}</b></td></tr>' +
                    '<tr><td style="color:{series.color};padding:0">Total Stok: </td>' +
                    '<td style="padding:0"><b>{point.stok}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                    name: 'Jumlah Produk',
                    colorByPoint: true,
                    data: category_name.map((name, index) => ({
                        name: name,
                        y: total_produk[index],
                        harga: total_harga[index],
                        stok: total_stok[index]
                    }))
                }],
        });
    });
</script>

@endsection
