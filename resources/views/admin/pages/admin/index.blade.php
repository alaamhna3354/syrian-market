@extends('admin.layouts.app')
@section('title')
    @lang("Admin List")
@endsection


@section('content')
    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body">
            <div class="dropdown mb-2 ">
                <a href="{{route('admin.admins.create')}}"
                   class="btn btn-primary btn-sm mr-3"><span>@lang('Add Admin')</span></a>
            </div>

            <div class="table-responsive">
                <table class="categories-show-table table table-hover table-striped table-bordered">
                    <thead class="thead-primary">
                    <tr>
                        <th scope="col">@lang('No.')</th>
                        <th scope="col">@lang('Name')</th>
                        <th scope="col">@lang('Username')</th>
                        <th scope="col">@lang('Email')</th>
                        <th scope="col">@lang('Phone')</th>
                        <th scope="col">@lang('Address')</th>
                        <th scope="col">@lang('Image')</th>
                        <th scope="col">@lang('Role')</th>
                        <th scope="col">@lang('Status')</th>
                        <th scope="col">@lang('Action')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($admins as $admin)
                        @if($admin->role!='Super')
                        <tr>
                            <td data-label="@lang('No.')">{{ $loop->index	 }}</td>
                            <td data-label="@lang('Name')">@lang($admin->name)</td>
                            <td data-label="@lang('Username')">@lang($admin->username)</td>
                            <td data-label="@lang('Email')">@lang($admin->email)</td>
                            <td data-label="@lang('Phone')">@lang(($admin->phone)? : 'N/A')</td>
                            <td data-label="@lang('Address')">{{$admin->address}}</td>
                            <td data-label="@lang('image')">
                                <img id="image_preview_container" class="preview-image" src="{{ getFile(config('location.admin.path').$admin->image) }}"
                                                                  alt="preview image" width="50px">
                            </td>
                            <td data-label="@lang('Role')">{{__($admin->role)}}</td>
                            <td data-label="@lang('Status')">
                                <span
                                        class="badge badge-pill {{ $admin->status == 0 ? 'badge-danger' : 'badge-success' }}">{{ $admin->status == 0 ? 'Inactive' : 'Active' }}</span>
                            </td>
                            <td data-label="@lang('Action')">
                                <div class="dropdown show">
                                        <a class="dropdown-item" href="{{ route('admin.admins.edit',$admin->id) }}">
                                            <i class="fa fa-edit text-warning pr-2"
                                               aria-hidden="true"></i> @lang('Edit')
                                        </a>
                                </div>
                            </td>
                        </tr>
                        @endif
                    @empty
                        <tr>
                            <td class="text-center text-danger" colspan="9">@lang('No User Data')</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>


            </div>
        </div>
    </div>

@endsection


