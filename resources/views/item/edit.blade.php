@extends('layouts.app', ['title' => __('Edit Item '.$item->name)])
@section('title','Edit Item '.$item->name)
@section('content')
    @include('users.partials.header', ['title' => __('Edit Item '.$item->name)])   
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Item Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                
                                <form action="{{route('item.destroy',$item->id)}}" method="post">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <div class="text-right">
                                        <a href="{{ route('item.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                                        <button type="submit" class="btn btn-danger btn-sm">{{ __('Delete Item') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        
                        <form method="post" action="{{ route('item.update',$item->id) }}" autocomplete="off">
                            @csrf
                            <input type="hidden" name="_method" value="PUT">
                            <h6 class="heading-small text-muted mb-4">{{ __('Item code : '.$item->code) }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ $item->name }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">`
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('categories_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Categories') }}</label>
                                    <select name="categories_id" class="form-control form-control-alternative{{ $errors->has('categories_id') ? ' is-invalid' : '' }}">
                                        <option value="{{$item->categories_id}}">{{$item->categories->name}}</option>
                                        @foreach ($categories as $items)
                                            <option value="{{$items->id}}">{{$items->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('categories_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('categories_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="form-group{{ $errors->has('stocks') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-stocks">{{ __('Stocks') }}</label>
                                    <input type="number" name="stocks" id="input-stocks" class="form-control form-control-alternative{{ $errors->has('stocks') ? ' is-invalid' : '' }}" placeholder="{{ __('Stocks') }}" value="{{ $item->stocks }}" required autofocus min="1">

                                    @if ($errors->has('stocks'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('stocks') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('price') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-price">{{ __('Price') }}</label>
                                    <input type="number" name="price" id="input-price" class="form-control form-control-alternative{{ $errors->has('price') ? ' is-invalid' : '' }}" placeholder="{{ __('Price') }}" value="{{ $item->price }}" required autofocus min="1">

                                    @if ($errors->has('price'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('price') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-description">{{ __('Description') }}</label>
                                    <textarea name="description" class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}" cols="30" rows="10" autofocus>{{ $item->description }}</textarea>
                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Update') }}</button>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
        
        @include('layouts.footers.auth')
    </div>
@endsection