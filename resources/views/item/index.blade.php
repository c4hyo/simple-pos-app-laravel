@extends('layouts.app', ['title' => __('User Management')])
@section('title','Items')
@section('content')
    @include('layouts.headers.cards')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Items') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                            <a href="{{route('item.create')}}" class="btn btn-sm btn-primary">{{ __('Add items') }}</a>
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
                                    <th scope="col">{{ __('Name Item') }}</th>
                                    <th scope="col">{{ __('Stocks') }}</th>
                                    <th scope="col">{{ __('Prices') }}</th>
                                    <th scope="col">{{ __('Categories')}}</th>
                                    <th scope="col">{{__('Edit')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $number = 1;
                                @endphp
                                @foreach ($item as $item)
                                    <tr>
                                        <td>{{__($number++)}}</td>
                                        <td>{{__($item->code)}}</td>
                                        <td>{{__($item->name)}}</td>
                                        <td>{{__($item->stocks)}}</td>
                                        <td>{{__(rupiah($item->price))}}</td>
                                        <td>{{__($item->categories->name)}}</td>
                                        <td><a href="{{route('item.edit',$item->id)}}" class="btn btn-warning btn-sm"><i class="fa fa-cog"></i>{{__(' Edit')}}</a></td>
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
    <script src="{{ asset('argon') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#items-table').DataTable();
        });
    </script>
@endpush