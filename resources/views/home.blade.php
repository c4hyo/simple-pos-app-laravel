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
                            <div class="row align-items-top pt-3">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="" class="label-control"> code </label>
                                        <input type="text" class="form-control" id="code" readonly>
                                        <input type="hidden" name="item_id" class="form-control" id="items_id" readonly>
                                        <input type="hidden" name="transaction_id" class="form-control" id="items_id" readonly>
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
                                </div>
                                <div class="col-2">
                                    <div class="form-group"> 
                                        <label for="" class="label-control center-text"> Id Transaction </label>
                                        <input type="text" name="code" class="form-control" value="{{getIdTransaction()}}" id="transaction_id" readonly>
                                    </div>
                                    <div class="form-group"> 
                                        <label for="" class="label-control center-text"> Date </label>
                                        <input type="text" class="form-control" id="date" value="{{date('d F Y')}}" readonly>
                                    </div>
                                    <div class="form-group" id="group-total">
                                        <label for="">Total</label>
                                        <input type="text" name="total" class="form-control" value="" id="total" readonly>
                                    </div>
                                    <div class="form-group">
                                        <button id="get-total" class="btn btn-primary btn-sm form-control">Update Total</button>
                                    </div>
                                    <div class="form-group">
                                        <button id="add-cart-btn" type="submit" class="btn btn-success form-control">Add Cart <i class="fa fa-arrow-right"></i></button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <table class="table table-flush" id="cart">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Qty</th>
                                                <th>Subtotal</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <link rel="stylesheet" href="{{asset('argon')}}/vendor/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{asset('argon')}}/vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link href="{{ asset('argon') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
@push('js')
    <script src="{{asset('argon')}}/vendor/select2/js/select2.full.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/datatables/sum().js"></script>
    <script src="{{asset('argon')}}/vendor/axios/axios.js"></script>
    <script>
        $(function () {
            var uri;
            $("#add-cart-btn").hide()
            $('#select2').select2({
                width: "100%"
            });
        });
        $("#group-total").hide();
        $("#get-total").hide();
        $("#select-item").unbind().click(function(){
            var itemId = $("#select2 option:selected").val()
            var code = $("#select2 option:selected").attr('data-code')
            var name = $("#select2 option:selected").attr('data-name')
            var stocks = $("#select2 option:selected").attr('data-stocks')
            var price = $("#select2 option:selected").attr('data-price')
            var quantity = $("#quantity").val("1")
            $("#add-cart-btn").toggle()
            $("#code").val(code)
            $("#name").val(name)
            $("#stocks").val(stocks)
            $("#price").val(price)
            $("#quantity").val("0").attr("max",stocks)
            $("#subtotal").val(price)
            $("#items_id").val(itemId)
            
            $("#quantity").change(function(){
                $("#subtotal").val(price*$(this).val())
                var newStock = $("#stocks").val(stocks-$(this).val())
            })
            $("#add-cart-btn").unbind().click(function(){
                // alert("gggg")
                $("#select2 option:selected").attr('data-stocks',parseInt($("#stocks").val()))
                var data = {
                    "item_id":itemId,
                    "transaction_id":null,
                    "name":name,
                    "stocks":parseInt($("#stocks").val()),
                    "price":parseInt(price),
                    "quantity":parseInt($("#quantity").val()),
                    "subtotal":parseInt($("#subtotal").val()),
                    "code":$("#transaction_id").val(),
                };
                if($("#stocks").val() == "0"){
                    alert("Out of Stock")
                }else{
                if($("#quantity").val() == "0"){
                    alert("please add")
                }else{
                    axios.post("{{route('transaction.store')}}",data).then(function(response){
                    if(response.statusText == "OK"){
                        $("#add-cart-btn").toggle()
                        $("#code").val("")
                        $("#name").val("")
                        $("#stocks").val("")
                        $("#price").val("")
                        $("#quantity").val("")
                        $("#subtotal").val("")
                        $("#items_id").val("")
                        alert("Sukses")
                        var uri = "{{route('transaction.index')}}/"+response.data;
                        var table = $('#cart').DataTable({
                            "searching":false,
                            "lengthChange": false,
                            "paging": false,
                            "sideserver" :true,
                            "ajax" : {
                                url :uri,
                                dataSrc :'',
                            },
                            columns :[
                                {data:"name"},
                                {data:'pivot.quantity'},
                                {data:"pivot.subtotal"},
                                {data:"code"},
                            ],
                        });
                        $("#get-total").show().click(function(){
                            $("#group-total").show()
                            var total = table.column(2).data().sum()
                            $("#total").val(total)
                            $(this).hide()
                        })
                        // if(!table.data().count()){
                        //     var total = table.column(2).data().sum()
                        //     $("#total").show().html("Total : "+total)
                        // }
                        table.ajax.reload()
                        }
                        else{
                            alert("Gagal")
                        }
                        
                    })
                }
            }
                
            });
        })
    </script>
@endpush