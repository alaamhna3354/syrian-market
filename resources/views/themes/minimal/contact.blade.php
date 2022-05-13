@extends($theme.'layouts.app')
@section('title')
    @lang($title)
@endsection

@section('content')



    <!-- CONTACT -->
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="d-flex align-items-center justify-content-start  wow fadeInLeft" data-wow-duration="1s"
                         data-wow-delay="0.35s">
                        <div class="wrapper">
                            <div class="contact-info-wrapper">
                                <h5 class="h5 mb-30">@lang(@$contact->title)</h5>
                                <p class="p mb-30">
                                    @lang(@$contact->sub_title)
                                </p>
                                <div class="media">
                                    <img src="{{getFile($themeTrue.'images/contact/list-img-1.png')}}"
                                         alt="Image Missing">
                                    <div class="media-body ml-20">
                                        <h6 class="h6 mb-5">{{trans('Address')}}</h6>
                                        <p class="p">{{@$contact->address}}</p>
                                    </div>
                                </div>
                                <div class="media">
                                    <img src="{{getFile($themeTrue.'images/contact/list-img-2.png')}}"
                                         alt="Image Missing">
                                    <div class="media-body ml-20">
                                        <h6 class="h6 mb-5">{{trans('Email')}}</h6>
                                        <p class="p">{{@$contact->email}}</p>
                                    </div>
                                </div>
                                <div class="media">
                                    <img src="{{getFile($themeTrue.'images/contact/list-img-3.png')}}"
                                         alt="Image Missing">
                                    <div class="media-body ml-20">
                                        <h6 class="h6 mb-5">{{trans('Phone')}}</h6>
                                        <p class="p">{{@$contact->phone}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div
                        class="form-wrapper w-100 h-100 d-flex flex-column align-items-start justify-content-center pl-65 wow fadeInRight"
                        data-wow-duration="1s" data-wow-delay="0.35s">
                        <p class="pheading text-uppercase mb-15">@lang(@$contact->heading)</p>
                        <h4 class="h4 text-capitalize mb-30">@lang(@$contact->sub_heading)</h4>
                        <form class="form-content w-100" action="{{route('contact.send')}}" method="post">
                            @csrf
                            <div class="contact">
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input class="form-control " name="name" value="{{old('name')}}" type="text"
                                                   placeholder="@lang('Name')">

                                            @error('name')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input class="form-control " name="email" value="{{old('email')}}"
                                                   type="email" placeholder="@lang('Email Address')">
                                            @error('email')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="subject"
                                                   value="{{old('subject')}}" placeholder="@lang('Subject')">
                                            @error('subject')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" cols="30" rows="4" name="message"
                                              placeholder="@lang('Message')">{{old('message')}}</textarea>
                                    @error('website')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <button class="btn mt-40" type="submit">{{trans('Send Message')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /CONTACT -->


@endsection
