@extends('layouts.app', ['title' => __('User Management')])
@section('title','Transaction')
@section('content')
    @include('layouts.headers.cards')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Transaction id: '.$transaction->code) }}</h3>
                                <h4 id="total"></h4>
                            </div>
                            <div class="col-4 text-right">
                            <a href="{{route('index.transaction')}}" class="btn btn-sm btn-primary">{{ __('Back') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>
                    <div class="table-responsive p-4">
                        <table class="table align-items-center table-flush" id="items-table">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('No') }}</th>
                                    <th scope="col">{{ __('Code') }}</th>
                                    <th scope="col">{{__('Items')}}</th>
                                    <th scope="col">{{__('Quantity')}}</th>
                                    <th scope="col">{{__('Subtotal')}}</th>
                                    <th scope="col">{{__('Detail')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $number = 1;
                                @endphp
                                @foreach ($transaction->items as $item)
                                    <tr>
                                        <td>{{__($number++)}}</td>
                                        <td>{{__($item->code)}}</td>
                                        <td>{{__($item->name)}}</td>
                                        <td>{{__($item->pivot->quantity)}}</td>
                                        <td id="subtotal">{{__($item->pivot->subtotal)}}</td>
                                        
                                    <td><a href="#" class="btn btn-primary btn-sm"><i class="fa fa-search"></i>{{__(' Detail')}}</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @include('layouts.footers.auth')
</div>
@endsection
@push('css')
    <link href="{{ asset('argon') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
@push('js')
    <script src="{{ asset('argon') }}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/datatables/sum().js"></script>
    <script src="{{ asset('argon') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            function rubah(angka){
                var reverse = angka.toString().split('').reverse().join(''),
                ribuan = reverse.match(/\d{1,3}/g);
                ribuan = ribuan.join('.').split('').reverse().join('');
                return "Rp. "+ribuan;
            }
            var table = $('#items-table').DataTable();
            var total = table.column(4).data().sum();
            $("#total").html("Total : "+rubah(total))

        });
    </script>
@endpush