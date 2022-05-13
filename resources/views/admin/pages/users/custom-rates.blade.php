@extends('admin.layouts.app')
@section('title', $title)
@section('content')

    <div id="app">

        <div class="page-header card card-primary m-0 m-md-4 my-4 m-md-0 p-5 shadow">
            <form action="{{ route('admin.payment.search') }}" method="get">
                <div class="row justify-content-between align-items-center">

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Select Category @{{category_id}}</label>
                            <select name="category" v-model="category_id" @change="changeCategory"
                                    class="form-control category">
                                <option value="" disabled>Select Category</option>
                                <option :value="category.id" v-for="category in categories">
                                    @{{category.category_title}}
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Select Service @{{service_id}} </label>
                            <select name="service" v-model="service_id" @change="selectService($event)"
                                    class="form-control service" id="service">
                                <option value="" v-if="0 < services.length" disabled>Select Service</option>
                                <option :value="service.id" v-for="service in services">
                                    @{{service.service_title}}
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Service Price @{{priceHint}}</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">{{trans('Price')}}</span>
                                </div>

                                <input type="text" v-model="amount" class="form-control">
                                <div class="input-group-append">
                                    <span class="input-group-text">{{config('basic.currency_symbol')}}</span>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <br>
                            <button type="button" @click="setUserRate" class="btn w-100 btn-success" :disabled="disabled"> @lang('Save') </button>
                        </div>
                    </div>


                </div>
            </form>

        </div>

        <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="categories-show-table table table-hover table-striped table-bordered">
                        <thead class="thead-primary">
                        <tr>
                            <th scope="col">@lang('Service Id')</th>
                            <th scope="col">@lang('Service Title')</th>
                            <th scope="col">@lang('Original Price')</th>
                            <th scope="col">@lang('Custom Price')</th>
                            <th scope="col">@lang('Action')</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(serve, index) in userServices" :key="index">
                                <td data-label="@lang('Service Id')"
                                    class="font-weight-bold text-uppercase">
                                    @{{serve.service.id}}</td>
                                <td data-label="@lang('Service')">@{{serve.service.service_title}}</td>
                                <td data-label="@lang('Orginal Price')">@{{serve.service.price}} {{config('basic.currency')}}</td>
                                <td data-label="@lang('Custom Price')">

                                    <input type="text" class="form-control"
                                           :value="serve.price" @input="inputPrice(serve.id, $event)">

                                </td>
                                <th scope="col">
                                    <button class="btn btn-sm btn-danger" type="button" @click="deleteService(serve)">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </th>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>



        <!--Refund Modal Start-->
        <div v-if="deleteModal" @close="deleteModal = false" class="modal " id="refundModal"
             tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
             style="display: block;overflow-y:auto;"
             data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog ">
                <div class="modal-content ">



                    <div class="modal-header modal-colored-header bg-primary">
                        <h4 class="modal-title">@lang('Delete Confirmation')</h4>
                        <button type="button" class="close btn btn-danger" @click="deleteModal = false"
                                data-dismiss="modal"><i
                                class="fal fa-times "></i></button>
                    </div>


                    <div class="modal-body">

                        <strong>@lang('Are you confirm to delete?')</strong>
                    </div>

                    <div class="modal-footer">

                        <button class="btn btn-light" type="button"
                                @click="deleteModal = false">
                            @lang('Close')
                        </button>

                        <button class="btn btn-primary" type="button" @click.prevent="deleteConfirm()">
                            @lang('Yes')
                        </button>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('js')

    <script src="{{ asset('assets/global/js/vue.min.js') }}"></script>

    <script>

        var app = new Vue({
            el: '#app',
            data: {
                deleteModal : false,
                user_id: "{{$user->id}}",
                category_id: '',
                service_id: '',
                priceHint: '',
                amount: '',
                userServices:[],
                categories: [],
                services: [],
                myService: {},
                deleteItem:{},
                disabled: true
            },
            beforeMount() {
                this.categories = @json($categories);

                this.serviceList();
            },
            mounted(){
            },
            watch: {
                category_id() {
                    this.checkField();
                },
                service_id() {
                    this.checkField();
                },
                amount(value) {
                    this.checkField();
                    console.log(value);
                }
            },
            methods: {
                serviceList(list = null){
                    if(list){
                        this.userServices = list;
                    }else{
                        this.userServices = @json($userServices);
                    }
                },

                changeCategory() {
                    var _this = this;
                    _this.service_id = '',
                    _this.priceHint = '',
                    _this.amount = '',

                        axios.get('{{route('admin.user.getService')}}', {
                            params: {
                                category_id: _this.category_id
                            }
                        })
                        .then(function (response) {
                            _this.services = response.data
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                },
                selectService(event) {
                    var serveId = event.target.value;
                    var _this = this;

                    var list = _this.services;

                    var result = list.filter((obj) => {
                        if (obj.id == serveId) {
                            _this.myService = obj
                            _this.amount = parseFloat(obj.price).toFixed(2)
                            _this.priceHint = (parseFloat(obj.price).toFixed(2)) + "{{config('basic.currency_symbol')}}"
                        }
                    });


                    axios.get('{{route('admin.user.getService')}}', {
                        params: {
                            service_id: serveId,
                            user_id: _this.user_id
                        }
                    })
                    .then(function (response) {
                        if (0 < response.data) {
                            _this.amount = parseFloat(response.data).toFixed(2)
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

                },


                checkField() {
                    if (this.category_id && this.service_id && this.amount) {
                        this.disabled = false;
                    } else {
                        this.disabled = true;
                    }
                },

                setUserRate() {

                    var _this = this;

                    axios.post('{{route('admin.user.setServiceRate')}}', {
                        user_id: this.user_id,
                        category_id: this.category_id,
                        service_id: this.service_id,
                        amount: this.amount,
                    })
                        .then(function (response) {
                            if(response.data.errors){
                                var getErrors = response.data.errors;
                                for(var err in getErrors){
                                    Notiflix.Notify.Failure(""+getErrors[err][0]);
                                }
                            }
                            if(response.data.success){
                                Notiflix.Notify.Success(""+response.data.success);
                                _this.serviceList(response.data.userServices)
                            }

                        })
                        .catch(function (error) {
                        });
                },


                inputPrice(id, event){


                    axios.get('{{route('admin.user.updateServiceRate')}}', {
                        params: {
                            id,
                            amount:event.target.value
                        }
                    })
                        .then(function (response) {
                            _this.services = response.data
                        })
                        .catch(function (error) {
                            console.log(error);
                        });


                },

                deleteService(item){
                    this.deleteItem = item;
                    this.deleteModal = true
                },
                deleteConfirm(){
                    var _this = this;

                    this.deleteModal = false;
                    axios.get('{{route('admin.user.deleteServiceRate')}}', {
                        params: {
                            id: _this.deleteItem.id
                        }
                    })
                        .then(function (response) {

                            if(response.data.success){
                                Notiflix.Notify.Success(""+response.data.success);
                                var existingId = _this.userServices.findIndex(i => i.id == _this.deleteItem.id);
                                if (existingId != -1) {
                                    _this.userServices.splice(existingId, 1);
                                }
                            }
                        })
                        .catch(function (error) {
                        });
                }

            }

        });

    </script>
@endpush
