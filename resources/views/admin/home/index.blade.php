@extends('layouts.main')

@section('title')
@endsection
@section('style')

    <style>
        p {
            margin: 0;
            padding: 0;
        }
        .information-day {
            background-color: white;
            padding: 10px 5px;
            display: flex;
            flex-direction: column;
        }
        .information-day__item {
            display: flex;
        }
        .information-day__content {
            display: flex;
            padding-top: 10px;
            height: 116px;
        }
        .item_has_border{
            border-right: 3px #17a2b8 solid;
            border-left: 3px #17a2b8 solid;
        }
        .item-icon {
            width: 60px;
            display: flex;
            justify-content: center;
            margin-right: 10px;
        }
        .information-month {
            display: flex;
            flex-direction: column;
            background-color: white;
            margin-top: 20px;
            padding: 10px;
        }
        .information-month__header {
            padding-bottom: 20px;
        }

        .information-month__content {

        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row information-day">
            <div class="information-day__header">
                <h4 style="margin-left: 20px; font-weight: 800">Kết quả bán hàng hôm nay</h4>
            </div>
            <div class="information-day__content">
                <div class="col-sm-3 information-day__item">
                    <div class="item-icon">
                        <i class="fas fa-cart-arrow-down" style="font-size: 45px; color: rgb(23 162 184)"></i>
                    </div>
                    <div>
                        <strong>Số hóa đơn</strong>
                        <h5 style="color: rgb(23 162 184)">{{$todaySalesResult['total_orders']}}</h5>
                    </div>
                </div>
                <div class="col-sm-3 information-day__item item_has_border">
                    <div class="item-icon">
                        <i class="fas fa-dollar-sign" style="font-size: 45px; color: orange"></i>
                    </div>
                    <div>
                        <strong>Tổng tiền hàng bán</strong>
                        <h5 style="color: orange" class="money">{{$todaySalesResult['total_money']}}</h5>
                        <p style="font-size: 12px; color: gray">Thực thu: <span class="money" style="color: gray">{{$todaySalesResult['total_actual_revenue']}}</span> </p>
                        <p style="font-size: 12px; color: gray">Khách nợ: <span class="money" style="color: gray">{{$todaySalesResult['total_debt']}}</span></p>
                    </div>
                </div>
                <div class="col-sm-3 information-day__item">
                    <div class="item-icon">
                        <i class="fas fa-users" style="color: rgb(76 155 239); font-size: 45px"></i>
                    </div>
                    <div>
                        <strong >Số khách hàng mới</strong>
                        <h5 style="color: rgb(76 155 239)">{{$todaySalesResult['new_customers']}}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="row information-month">
            <div class="information-month__header">
                <h4 style="margin-left: 20px; font-weight: 800">Doanh thu tháng này</h4>
            </div>
            <div class="information-month__content">
                <div class="row">
                    <div class="col-sm-12">
                        <div style="height: 450px">
                            <canvas style="max-height: 400px" id="revenue-month-chart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row information-month">
            <div class="information-month__header">
                <h4 style="margin-left: 20px; font-weight: 800">Top hàng hóa bán chạy tháng này</h4>
            </div>
            <div class="information-month__content">
                <div class="row">
                    <div class="col-sm-12">
                        <div style="height: 450px">
                            <canvas style="max-height: 400px" id="best-seller-chart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript" src="{{ asset('js/simple.money.format.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var dt = new Date();
            var month = dt.getMonth();
            var year = dt.getFullYear();
            daysInMonth = new Date(year, month, 0).getDate();
            days = [];
            for (i = 1; i<= daysInMonth; i++) {
                days.push(i);
            }
            var revenueChart = document.getElementById('revenue-month-chart');
            var revenueMonthChart = new Chart(revenueChart, {
                type: 'bar',
                data: {
                    labels: days,
                    datasets: [
                        {
                            label: 'Revenue of month',
                            data: {{json_encode($monthOrders)}},
                            backgroundColor: 'rgba(255,137,60,0.92)',
                            borderWidth: 1
                        },
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            var bestSellerChart = document.getElementById('best-seller-chart');
            var bestSellerOfMonthChart = new Chart(bestSellerChart, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($bestSaleProductNames) !!},
                    datasets: [
                        {
                            label: 'Best selling products of month',
                            data: {!! json_encode($quantityBestSaleProduct) !!},
                            backgroundColor: 'rgba(255,137,60,0.92)',
                            borderWidth: 1
                        },
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    indexAxis: 'y'
                }
            });
            $('.money').simpleMoneyFormat();
        });
    </script>


@endsection
