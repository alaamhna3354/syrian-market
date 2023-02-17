@extends('admin.layouts.app')
@section('title', isset($apiServiceLists[0]['category']) ? $apiServiceLists[0]['category'] : $provider->api_name)
@section('content')

    <div class="card card-primary m-0 m-md-4 my-4 m-md-0">
        <div class="card-body">
            <div class="table-responsive ">
                <table class="table table-hover table-striped table-bordered">
                    <thead class="thead-primary">
                    <tr class="text-center">
                        <th scope="col">@lang('ID')</th>
                        <th scope="col">@lang('Name')</th>
                        <th scope="col">@lang('Category')</th>
                        <th scope="col">@lang('Price')</th>
                        <th scope="col">@lang('Action')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($apiServiceLists as $service)
                        <tr>
                            <td class="text-center">{{$service['service']}}</td>
                            <td class="text-center">
                                {{\Str::limit($service['name'], 30)}}
                            </td>
                            <td class="text-center">{{$service['category']}}</td>
                            <td class="text-center">
                                {{ $service['rate'] }}
                            </td>
                            <td class="text-center">
                                <div class="dropdown show">
                                    <a href="javascript:void(0)" class="dropdown-item import-single import-single-ashab"
                                       data-toggle="modal"
                                       data-target="#importMoldalSer"
                                       data-price="{{$service['rate']}}"
                                       data-name="{{$service['name']}}"
                                       data-min="{{$service['min']}}"
                                       data-max="{{$service['max']}}"
                                       data-route="{{ route('admin.import-custom-api.services',['id'=>$service['service'],'name'=>$service['name'],'category'=>$service['category'],'rate'=>$service['rate'], 'provider'=>$provider->id]) }}">
                                        <i class="fas fa-plus text-success pr-2"></i> @lang('Import Service')</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="importMoldalSer" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">@lang('Service Import Confirm')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post" id="importForm">
                    @csrf

                    <div class="modal-body">
                        <div class="form-group">
                            <label>@lang('Name')</label>
                            <input id="name" type="text" class="form-control square"
                                   value="">

                        </div>
                        <div class="form-group">
                            <label>@lang('Select Category')</label>
                            <select class="form-control" id="category_id" name="category_id"
                                    onchange="showExtraField()" required>
                                <option disabled value="" selected hidden>@lang('Select Category')</option>
                                @foreach($categories as $key=>$categorie)
                                    <option value="{{ $categorie->id  }}"
                                            id="{{$categorie->type}}_{{$key}}">@lang($categorie->category_title)</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Minimum Amount')</label>
                                    <input type="number" class="form-control square" name="min_amount" id="min_amount"
                                           value="{{ old('min_amount',1) }}">
                                    @if($errors->has('min_amount'))
                                        <div class="error text-danger">@lang($errors->first('min_amount')) </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>@lang('Price')</label>
                                    <input id="price" type="text" class="form-control square" name="price"
                                           placeholder="0.00"
                                           value="{{ old('price') }}">
                                    @if($errors->has('price'))
                                        <div class="error text-danger">@lang($errors->first('price')) </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>@lang('Points')</label>
                                    <input type="number" class="form-control square" name="points" placeholder="0"
                                           value="{{ old('points') }}">
                                    @if($errors->has('points'))
                                        <div class="error text-danger">@lang($errors->first('points')) </div>
                                    @endif
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Maximum Amount')</label>
                                    <input type="number" class="form-control square" name="max_amount" id="max_amount"
                                           value="{{ old('max_amount',500) }}">
                                    @if($errors->has('max_amount'))
                                        <div class="error text-danger">@lang($errors->first('max_amount')) </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>@lang('Agent Commission Rate')</label>
                                    <input type="text" class="form-control square" name="agent_commission_rate"
                                           placeholder="0"
                                           value="{{ old('agent_commission_rate') }}">
                                    @if($errors->has('agent_commission_rate'))
                                        <div
                                            class="error text-danger">@lang($errors->first('agent_commission_rate')) </div>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label class="d-block">@lang('Status')</label>
                                            <div class="custom-switch-btn">
                                                <input type='hidden' value='1' name='service_status'>
                                                <input type="checkbox" name="service_status"
                                                       class="custom-switch-checkbox"
                                                       id="service_status" value="0">
                                                <label class="custom-switch-checkbox-label" for="service_status">
                                                    <span class="custom-switch-checkbox-inner"></span>
                                                    <span class="custom-switch-checkbox-switch"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label class="d-block">@lang('Available')</label>
                                            <div class="custom-switch-btn">
                                                <input type='hidden' value='1' name='is_available'>
                                                <input type="checkbox" name="is_available"
                                                       class="custom-switch-checkbox"
                                                       id="is_available" value="0">
                                                <label class="custom-switch-checkbox-label" for="is_available">
                                                    <span class="custom-switch-checkbox-inner"></span>
                                                    <span class="custom-switch-checkbox-switch"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label " for="fieldone">@lang('Description')</label>
                            <textarea class="form-control" rows="4" placeholder="@lang('Description') "
                                      name="description"></textarea>

                            @if($errors->has('description'))
                                <div class="error text-danger">@lang($errors->first('description')) </div>
                            @endif
                        </div>
                        <p>@lang('Are you really want to Import Service')</p>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal"><span><i
                                    class="fas fa-power-off"></i> @lang('Cancel')</span></button>
                        <button type="submit" class="btn btn-primary"><span><i
                                    class="fas fa-save"></i> @lang('Confirm Import')</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">@lang('Confirm Status Change')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post" id="importForm">
                    @csrf

                    <div class="modal-body">
                        <div class="form-group">
                            <label>@lang('Select Percentage Increase')</label>
                            <select class="form-control" name="price_percentage_increase">
                                <option value="100" selected>@lang('100%')</option>
                                @for($loop = 0; $loop <= 1000; $loop++)
                                    <option value="{{ $loop }}">{{ $loop }} %</option>
                                @endfor
                            </select>
                        </div>

                        <p>@lang('Are you really want to Import Service')</p>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal"><span><i
                                    class="fas fa-power-off"></i> @lang('Cancel')</span></button>
                        <button type="submit" class="btn btn-primary"><span><i
                                    class="fas fa-save"></i> @lang('Confirm Import')</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="importMultipleMoldal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">@lang('Confirm Status Change')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post" id="importMultipleForm">
                    @csrf

                    <div class="modal-body">
                        <div class="form-group">
                            <label>@lang('Bulk add limit')</label>
                            <select class="form-control" name="import_quantity">
                                @for($loop = 25; $loop <= 1000; $loop+=25)
                                    <option value="{{ $loop }}">{{ $loop }}</option>
                                @endfor
                                <option value="all">All</option>
                            </select>
                        </div>

                        <p>@lang('Are you really want to Import All Service')</p>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal"><span><i
                                    class="fas fa-power-off"></i> @lang('Cancel')</span></button>
                        <button type="submit" class="btn btn-primary"><span><i
                                    class="fas fa-save"></i> @lang('Confirm Import')</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        "use strict";
        $(document).ready(function () {
            $(document).on('click', '#check-all', function () {
                $('input:checkbox').not(this).prop('checked', this.checked);
            });

            $(document).on('change', ".row-tic", function () {
                let length = $(".row-tic").length;
                let checkedLength = $(".row-tic:checked").length;
                if (length == checkedLength) {
                    $('#check-all').prop('checked', true);
                } else {
                    $('#check-all').prop('checked', false);
                }
            });
            $(document).on('click', '.import-single', function () {
                let route = $(this).data('route');
                $('#importForm').attr('action', route);
            });
            $(document).on('click', '.import-single-ashab', function () {
                let price = $(this).data('price');
                var priceInput = document.getElementById('price')
                priceInput.value = price
            });
            $(document).on('click', '.import-single-ashab', function () {
                let name = $(this).data('name');
                var nameInput = document.getElementById('name')
                nameInput.value = name
            });
            $(document).on('click', '.import-single-ashab', function () {
                let min = $(this).data('min');
                var minInput = document.getElementById('min_amount')
                minInput.value = min
            });
            $(document).on('click', '.import-single-ashab', function () {
                let max = $(this).data('max');
                var maxInput = document.getElementById('max_amount')
                maxInput.value = max
            });
            $(document).on('click', '.import-multiple', function () {
                let route = $(this).data('route');
                $('#importMultipleForm').attr('action', route);
            });

        });
    </script>
@endpush

