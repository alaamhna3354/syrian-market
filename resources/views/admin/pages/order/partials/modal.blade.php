

<div class="modal fade" id="statusMoldal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">@lang('Confirm Status Change')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" id="statusForm">
                @csrf

                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label " for="statusCahnge">@lang('Select Status')</label>
                        <select class="form-control" name="statusChange" required>
                            <option value="awaiting">@lang('Awaiting')</option>
                            <option value="pending">@lang('Pending')</option>
                            <option value="processing">@lang('Processing')</option>
                            <option value="progress">@lang('In progress')</option>
                            <option value="completed">@lang('Completed')</option>
                            <option value="partial">@lang('Partial')</option>
                            <option value="canceled">@lang('Canceled')</option>
                            <option value="refunded">@lang('Refunded')</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">  @lang('Cancel')</button>
                    <button type="submit" class="btn btn-primary"> @lang('Save Changes')</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="usersOrderChangeStatus" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-primary">
                <h5 class="modal-title">@lang('Order Status Change')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    ×
                </button>
            </div>

            <div class="modal-body">
                <p>@lang("Are you really want to <span class='text-info text-status'>Awaiting</span> this orders")</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal"><span>@lang('No')</span></button>
                <form action="" method="post" id="changeOrderStatus">
                    @csrf
                    <a href="" class="btn btn-primary awaiting-yes" data-status=""><span>@lang('Yes')</span></a>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="deleteModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-primary">
                <h5 class="modal-title">@lang('Order Delete Confirm')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    ×
                </button>
            </div>

            <div class="modal-body">
                <p>@lang("Are you really want to delete this orders")</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal"><span>@lang('No')</span></button>
                <form action="" method="post" id="deleteConfirm">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-primary "><span>@lang('Yes')</span>
                    </button>

                </form>
            </div>
        </div>
    </div>
</div>
