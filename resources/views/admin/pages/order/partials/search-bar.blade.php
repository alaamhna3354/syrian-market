
<div class="page-header card card-primary m-0 m-md-4 my-4 m-md-0 p-5">
    <div class="row">
        <div class="col-xl-10">

            <form action="{{ route('admin.order-search') }}" method="get">
                <div class="row">
                    <div class="col-md-4 col-xl-3">
                        <div class="form-group">
                            <input type="text" name="order_id" value="{{@request()->order_id}}" class="form-control"
                                   placeholder="@lang('Order ID')">
                        </div>
                    </div>
                    <div class="col-md-4 col-xl-3">
                        <div class="form-group">
                            <input type="text" name="service" value="{{@request()->service}}" class="form-control get-service"
                                   placeholder="@lang('Service')">
                        </div>
                    </div>
                    <div class="col-md-4 col-xl-3">
                        <div class="form-group">
                            <select name="status" class="form-control" id="status">
                                <option value="">@lang('All Status')</option>
                                <option value="awaiting" @if(@request()->status == 'awaiting') selected @endif>@lang('Awaiting')</option>
                                <option value="pending" @if(@request()->status == 'pending') selected @endif>@lang('Pending')</option>
                                <option value="processing" @if(@request()->status == 'processing') selected @endif>@lang('Processing')</option>
                                <option value="progress" @if(@request()->status == 'progress') selected @endif>@lang('In Progress')</option>
                                <option value="completed" @if(@request()->status == 'completed') selected @endif>@lang('Completed')</option>
                                <option value="partial" @if(@request()->status == 'partial') selected @endif>@lang('Partial')</option>
                                <option value="canceled" @if(@request()->status == 'canceled') selected @endif>@lang('Cancelled')</option>
                                <option value="refunded" @if(@request()->status == 'refunded') selected @endif>@lang('Refunded')</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4 col-xl-3">
                        <div class="form-group">
                            <input type="date" class="form-control" name="date_time" id="datepicker"/>
                        </div>
                    </div>

                    <div class="col-md-4 col-xl-3">
                        <div class="form-group">
                            <input type="text" name="user" value="{{@request()->user}}" class="form-control get-user"
                                   placeholder="@lang('User')">
                        </div>
                    </div>


                    <div class="col-md-4 col-xl-3">
                        <div class="form-group">
                            <button type="submit" class="btn w-100  btn-primary"><i class="fas fa-search"></i> @lang('Search')</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>

        <div class="col-xl-2 d-flex justify-content-md-end justify-content-start">
            <div class="dropdown">
                <button class="btn  btn-dark btn-sm dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span><i class="fas fa-bars pr-2"></i> @lang('Action')</span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <button class="dropdown-item usersOrderChangeStatus" type="button" data-toggle="modal"
                            data-target="#usersOrderChangeStatus" data-status="awaiting">@lang('Awaiting')</button>
                    <button class="dropdown-item usersOrderChangeStatus" type="button" data-toggle="modal"
                            data-target="#usersOrderChangeStatus" data-status="pending">@lang('Pending')</button>
                    <button class="dropdown-item usersOrderChangeStatus" type="button" data-toggle="modal"
                            data-target="#usersOrderChangeStatus" data-status="processing">@lang('Processing')</button>
                    <button class="dropdown-item usersOrderChangeStatus" type="button" data-toggle="modal"
                            data-target="#usersOrderChangeStatus" data-status="progress">@lang('In Progress')</button>
                    <button class="dropdown-item usersOrderChangeStatus" type="button" data-toggle="modal"
                            data-target="#usersOrderChangeStatus" data-status="completed">@lang('Completed')</button>
                    <button class="dropdown-item usersOrderChangeStatus" type="button" data-toggle="modal"
                            data-target="#usersOrderChangeStatus" data-status="partial">@lang('Partial')</button>
                    <button class="dropdown-item usersOrderChangeStatus" type="button" data-toggle="modal"
                            data-target="#usersOrderChangeStatus" data-status="canceled">@lang('Canceled')</button>
                    <button class="dropdown-item usersOrderChangeStatus" type="button" data-toggle="modal"
                            data-target="#usersOrderChangeStatus" data-status="refunded">@lang('Refunded')</button>
                </div>
            </div>
        </div>

    </div>
</div>



@push('js')
    <script>
        "use strict";
        $(document).ready(function () {

            $('#status').select2({
                selectOnClose: true
            });
        });
</script>
@endpush
