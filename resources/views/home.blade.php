@extends('layouts.app', ['title' => __('User Management')])
@section('title','Dashboard')
@section('content')
    @include('layouts.headers.cards')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div>
                            Today : {{date('d F Y')}}
                        </div>
                        <div class="row align-items-center">
                            <div class="col-10">
                                <select id="select2" class="form-control col-12">
                                    <option selected>Select Item</option>
                                    @foreach ($category as $category)
                                        @foreach ($category->items as $item)
                                            <option value="{{$item->id}}" data-code="{{$item->code}}" data-stocks="{{$item->stocks}}" data-price="{{$item->price}}" data-name="{{$item->name}}"> ({{$item->code}})  {{$item->name}}</option>
                                        @endforeach                                        
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2">
                                <a href="#" class="col-12 btn btn-sm btn-success" id="select-item">Select</a>
                            </div>
                        </div>
                        <div class="row align-items-center pt-3">
                            <div class="col-4">
                                <form action="" method="post" class="form-group">
                                    @csrf
                                    <div class="form-group">
                                        <label for="" class="label-control"> code </label>
                                        <input type="text" class="form-control" name="code" id="code" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="label-control"> name </label>
                                        <input type="text" class="form-control" name="name" id="name" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="label-control"> stocks </label>
                                        <input type="text" class="form-control" name="stocks" id="stocks" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="label-control"> price </label>
                                        <input type="text" class="form-control" name="price" id="price" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="label-control"> quantity </label>
                                        <input type="number" class="form-control" min="1" name="quantity" id="quantity">
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="label-control"> subtotal </label>
                                        <input type="number" class="form-control" name="subtotal" id="subtotal" readonly>
                                    </div>
                                </form>
                            </div>
                            <div class="col-2">
                                <div class="center-text"> 
                                    <label for="" class="label-control center-text"> Id Transaction </label>
                                    <input type="text" class="form-control" id="transaction_id" readonly>
                                </div>
                                <div class="center-text"> 
                                    <label for="" class="label-control center-text"> Date </label>
                                    <input type="text" class="form-control" id="date" value="{{date('d F Y')}}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <link href="{{ asset('argon') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('argon')}}/vendor/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{asset('argon')}}/vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endpush
@push('js')
    <script src="{{asset('argon')}}/vendor/select2/js/select2.full.min.js"></script>
    <script>
        $(function () {
            $('#select2').select2({
                width: "100%"
            });
        });
        $("#select-item").unbind().click(function(){
            var code = $("#select2 option:selected").attr('data-code')
            var name = $("#select2 option:selected").attr('data-name')
            var stocks = $("#select2 option:selected").attr('data-stocks')
            var price = $("#select2 option:selected").attr('data-price')
            var quantity = $("#quantity").val("1")
            $("#code").val(code)
            $("#name").val(name)
            $("#stocks").val(stocks)
            $("#price").val(price)
            $("#quantity").val("1")
            $("#subtotal").val(price)
            
            $("#quantity").change(function(){
                if($(this).val() > stocks){
                    alert("Out of Stocks")
                    $(this).val(stocks)
                }else{
                    $("#subtotal").val(price*$(this).val())
                }
            })
        })
        
        
    </script>
@endpush