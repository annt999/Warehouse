@extends('layouts.main')

@section('title')
    WareHouse | Order
@endsection
@section('header')
    <h1 class="m-0">Create order</h1>
@endsection
@section('style')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row" style="">
            <div class="order-left" style="width: 57%; min-height: 80vh; background-color: #a0d0e2; margin-right: 30px">
                <div class="input-search" style="display: flex; flex-direction: row;justify-content: space-between; padding: 20px;">
                    <span>Search</span>
                    <input type="text" class="input-group form-control" style="width: 75%">
                </div>
                <div class="result-search">
                    <div class="item-result" style="height: 80px; background-color: white; border-bottom: 3px #0000007a solid; display: flex; flex-direction: row; align-items: center; justify-content: space-around">
                        <div class="image-item" style="width: 60px; height: 60px">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/92/UNIQLO_logo.svg/204px-UNIQLO_logo.svg.png" >
                        </div>
                        <div class="code-item">
                            <p style="color: black">TS1234567890</p>
                        </div>
                        <div class="name-item">
                            <p style="color: black">Uniqlo T-shirt</p>
                        </div>
                        <div class="price-item">
                            <p style="color: black">500.000đ</p>
                        </div>
                        <div class="add-card-item">
                            <button class="btn btn-info"><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                </div>
                <div class="result-search">
                    <div class="item-result" style="height: 80px; background-color: white; border-bottom: 3px #0000007a solid; display: flex; flex-direction: row; align-items: center; justify-content: space-around">
                        <div class="image-item" style="width: 60px; height: 60px">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/92/UNIQLO_logo.svg/204px-UNIQLO_logo.svg.png" >
                        </div>
                        <div class="code-item">
                            <p style="color: black">TS1234567890</p>
                        </div>
                        <div class="name-item">
                            <p style="color: black">Uniqlo T-shirt</p>
                        </div>
                        <div class="price-item">
                            <p style="color: black">500.000đ</p>
                        </div>
                        <div class="add-card-item">
                            <button class="btn btn-info"><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="order-right" style="width: 37%; min-height: 80vh; background-color: #a0d0e2">
                <div class="title-invoice" style="width: 100%; height: 100px; padding: 30px; display: flex;">
                    <h3 style="color: black; width: 50%">Hóa đơn</h3>
                    <div style="width: 50%">
                        <div>
                            <span>Khách hàng:  Trần Hà Trang</span>
                        </div>
                        <div>
                            <span>Số điện thoại:  0966829832</span>
                        </div>

                    </div>
                </div>

                <div class="invoice-item" style="height: auto; width: 100%; padding: 15px; display: flex; flex-wrap: wrap">
                    <div style="width: 40%;margin-bottom:30px">
                        <span>Tổng tiền hàng</span>
                    </div>
                    <div style="width: 40%;margin-bottom:30px; border-bottom: 1px gray solid">
                        <span>500.000đ</span>
                    </div>
                    <div style="width: 40%;margin-bottom:30px">
                        <span>Giảm giá</span>
                    </div>
                    <div style="width: 40%;margin-bottom:30px; border-bottom: 1px gray solid">
                        <span>0</span>
                    </div>
                    <div style="width: 40%;margin-bottom:30px">
                        <span>Thu khác</span>
                    </div>
                    <div style="width: 40%; margin-bottom:30px; border-bottom: 1px gray solid">
                        <span>0</span>
                    </div>
                    <div style="width: 40%;margin-bottom:30px">
                        <span>Khách cần trả</span>
                    </div>
                    <div style="width: 40%; margin-bottom:30px; border-bottom: 1px gray solid">
                        <span>500.000đ</span>
                    </div>
                    <div style="width: 40%;margin-bottom:30px">
                        <span>Tiền thừa</span>
                    </div>
                    <div style="width: 40%;margin-bottom:30px; border-bottom: 1px gray solid">
                        <span>0</span>
                    </div>
                    <div style="width: 40%;margin-bottom:30px">
                        <span>Tiền khách nợ</span>
                    </div>
                    <div style="width: 40%;margin-bottom:30px; border-bottom: 1px gray solid">
                        <span>0</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js" ></script>
    <script>

        var path = "{{ url('product/search') }}";

        $('#user_name').typeahead({

            source: function(query, process){

                return $.get(path, {query:query}, function(data){

                    return process(data);

                });
            },
            updater: function(item) {
                console.log(item)
            }

        });

    </script>
@endsection

