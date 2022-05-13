@extends('user.layouts.app')
@section('title')
    @lang($page_title)
@endsection
@section('content')


    <div class="container">
        <ol class="breadcrumb center-items">
            <li><a href="{{route('user.home')}}">@lang('Home')</a></li>
            <li class="active">@lang($page_title)</li>
        </ol>
        <div class="row my-3">

            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">

                        <h5 class="card-title m-2 ">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-sm-10">
                                    @if($ticket->status == 0)
                                        <span class="badge badge-pill badge-primary">@lang('Open')</span>
                                    @elseif($ticket->status == 1)
                                        <span class="badge badge-pill badge-success">@lang('Answered')</span>
                                    @elseif($ticket->status == 2)
                                        <span class="badge badge-pill badge-dark">@lang('Customer Reply')</span>
                                    @elseif($ticket->status == 3)
                                        <span class="badge badge-pill badge-danger">@lang('Closed')</span>
                                    @endif
                                    [{{trans('Ticket#'). $ticket->ticket }}] {{ $ticket->subject }}
                                </div>
                                <div class="col-sm-2 text-sm-right mt-sm-0 mt-3">

                                    <button type="button" class="btn btn-sm btn-outline-danger btn-rounded" data-toggle="modal"
                                            data-target="#closeTicketModal"><i
                                            class="fas fa-times-circle"></i> {{trans('Close')}}</button>


                                </div>
                            </div>
                        </h5>
                        <div class="card-body border mx-2">
                            <form class="form-row" action="{{ route('user.ticket.reply', $ticket->id)}}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="col-sm-10 col-12">
                                    <div class="form-group mt-0 mb-0">
                                        <textarea name="message"  class="form-control  ticket-box" id="textarea1"  placeholder="@lang('Type Here')" rows="3">{{old('message')}}</textarea>
                                    </div>
                                    @error('message')
                                    <span class="text-danger">{{trans($message)}}</span>
                                    @enderror
                                </div>


                                <div class="col-sm-2 col-12">
                                    <div
                                        class="justify-content-sm-end justify-content-start mt-sm-0 mt-2 align-items-center d-flex h-100">
                                        <div class="upload-btn">
                                            <div class="btn btn-primary new-file-upload mr-3"
                                                 title="{{trans('Image Upload')}}">
                                                <a href="#">
                                                    <i class="fa fa-image"></i>
                                                </a>
                                                <input type="file" name="attachments[]" id="upload" class="upload-box"
                                                       multiple
                                                       placeholder="@lang('Upload File')">
                                            </div>
                                            <p class="text-danger select-files-count"></p>
                                        </div>

                                        <button type="submit"
                                                class="btn btn-circle btn-lg btn-success float-right text-white"
                                                title="{{trans('Reply')}}" name="replayTicket"
                                                value="1"><i class="fas fa-paper-plane"></i></button>
                                    </div>

                                    @error('attachments')
                                    <span class="text-danger">{{trans($message)}}</span>
                                    @enderror
                                </div>
                            </form>
                        </div>


                        @if(count($ticket->messages) > 0)
                            <div class="chat-box scrollable position-relative scroll-height">
                                <ul class="chat-list list-style-none ">
                                    @foreach($ticket->messages as $item)
                                        @if($item->admin_id == null)



                                            <li class="chat-item list-style-none replied mt-3 text-right">
                                                <div class="chat-img d-inline-block">

                                                    <img
                                                        src="{{getFile(config('location.user.path').optional($ticket->user)->image)}}"
                                                        alt="user"
                                                        class="rounded-circle" width="45">
                                                </div>
                                                <div class="w-100">
                                                    <div class="chat-content d-inline-block pr-3">
                                                        <h6 class="font-weight-medium">{{optional($ticket->user)->username}} </h6>

                                                        <div class="media flex-row-reverse">

                                                            <div class="msg p-2 d-inline-block mb-1">
                                                                {{$item->message}}
                                                            </div>

                                                        </div>

                                                        @if(0 < count($item->attachments))
                                                            <div class="d-flex justify-content-end">
                                                                @foreach($item->attachments as $k=> $image)
                                                                    <a href="{{route('user.ticket.download',encrypt($image->id))}}"
                                                                       class="ml-3 nowrap "><i
                                                                            class="fa fa-file"></i> @lang('File') {{++$k}} </a>
                                                                @endforeach
                                                            </div>
                                                        @endif


                                                    </div>
                                                    <div
                                                        class="chat-time d-block font-10 mt-0 mr-0 mb-3">{{dateTime($item->created_at, 'd M, y h:i A')}}
                                                    </div>
                                                </div>

                                            </li>

                                        @else

                                            <li class="chat-item list-style-none mt-3">
                                                <div class="chat-img d-inline-block">
                                                    <img
                                                        src="{{getFile(config('location.admin.path').optional($item->admin)->image)}}"
                                                        alt="user"
                                                        class="rounded-circle" width="45">
                                                </div>
                                                <div class="chat-content d-inline-block pl-3">
                                                    <h6 class="font-weight-medium">{{optional($item->admin)->name}}</h6>

                                                    <div class="media">
                                                        <div class="msg p-2 d-inline-block mb-1">
                                                            {{$item->message}}
                                                        </div>

                                                    </div>


                                                    @if(0 < count($item->attachments))
                                                        <div class="d-flex justify-content-start">
                                                            @foreach($item->attachments as $k=> $image)
                                                                <a href="{{route('user.ticket.download',encrypt($image->id))}}"
                                                                   class="mr-3 nowrap"><i
                                                                        class="fa fa-file"></i> @lang('File') {{++$k}}
                                                                </a>
                                                            @endforeach
                                                        </div>
                                                    @endif


                                                </div>
                                                <div class="chat-time d-block font-10 mt-0 mr-0 mb-3">{{dateTime($item->created_at, 'd M, y h:i A')}}</div>
                                            </li>


                                        @endif
                                    @endforeach

                                </ul>
                            </div>
                        @endif



                    </div>
                </div>

            </div>

        </div>
    </div>



    <div class="modal fade" id="closeTicketModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-content-bg">

                <form method="post" action="{{ route('user.ticket.reply', $ticket->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="modal-header modal-colored-header bg-primary">
                        <h5 class="modal-title"> @lang('Confirmation')!</h5>

                        <button type="button" class="close close-button" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>@lang('Are you want to close ticket?')</p>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-light" data-dismiss="modal">
                            @lang('Close')
                        </button>

                        <button type="submit" class="btn btn-primary" name="replayTicket"
                                value="2">@lang("Confirm")
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection


@push('js')
    <script>
        'use strict';
        $(document).on('change', '#upload', function () {
            var fileCount = $(this)[0].files.length;
            $('.select-files-count').text(fileCount + ' file(s) selected')
        })
    </script>
@endpush


