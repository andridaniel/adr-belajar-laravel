@extends('layouts.main')

@section('konten')

<div id="container">
        <div id="container"></div>
    
    <script>
        var category_name = <?php echo json_encode($data['category_name']); ?>;
        var total_produk = <?php echo json_encode($data['total_produk']); ?>;
        var total_harga = <?php echo json_encode($data['total_harga']); ?>;
        var total_stok = <?php echo json_encode($data['total_stok']); ?>;
        
        document.addEventListener('DOMContentLoaded', function () {
            Highcharts.chart('container', {
                chart: {
                    type: 'pie'
                },
                title: {
                    text: 'Informasi Produk per Kategori',
                    style: {
                        color: '#000000'
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
                tooltip: {
                    pointFormat: '<span style="color:{point.color}">\u25CF</span> {series.name}: <b>{point.y}</b><br/>' +
                        'Total Harga: <b>{point.harga}</b><br/>' +
                        'Total Stok: <b>{point.stok}</b>',
                    style: {
                        color: '#000000'
                    }
                },
                plotOptions: {
                    pie: {
                        dataLabels: {
                            color: '#000000',
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.y}',
                            distance: -30
                        }
                    }
                }
            });
        });
    </script>
</div>
@endsection