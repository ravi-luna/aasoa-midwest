@extends('frontend.include.layout')
@section('content')
    <div class="form-w3layouts">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Attendee Registration
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <form method="post" enctype="multipart/form-data" action="{{ route('validate_attendee') }}">
                                @csrf
                                <div class="form-group">
                                    <label class="exampleInputEmail1" for="name">Name</label>
                                    <input type="text" class="form-control" id="exampleInputEmail2" name="name">
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="exampleInputEmail1" for="company_name">Company
                                        Name</label>
                                    <input type="text" class="form-control" id="exampleInputEmail2" name="company_name">
                                    @if ($errors->has('company_name'))
                                        <span class="text-danger">{{ $errors->first('company_name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="exampleInputEmail1" for="email">Email</label>
                                    <input type="text" class="form-control" id="exampleInputEmail2" name="email">
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="exampleInputEmail1" for="phone_number">Phone
                                        Number</label>
                                    <input type="number" class="form-control" id="exampleInputEmail2" name="phone_number">
                                    @if ($errors->has('phone_number'))
                                        <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="exampleInputEmail1" for="address">Address</label>
                                    <input type="text" class="form-control" id="exampleInputEmail2" name="address">
                                    @if ($errors->has('address'))
                                        <span class="text-danger">{{ $errors->first('address') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="exampleInputEmail1" for="city">City
                                    </label>
                                    <input type="text" class="form-control" id="exampleInputEmail2" name="city">
                                    @if ($errors->has('city'))
                                        <span class="text-danger">{{ $errors->first('city') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="exampleInputEmail1" for="state">States</label>
                                    <select class="form-control m-bot15" name="state">
                                        <option value="">Select State</option>
                                        @foreach ($states as $stateId => $stateName)
                                            <option value="{{ $stateId }}">{{ $stateName }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('state'))
                                        <span class="text-danger">{{ $errors->first('state') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="exampleInputEmail1" for="zip_code">Zip Code</label>
                                    <input type="number" class="form-control" id="exampleInputEmail2" name="zip_code">
                                    @if ($errors->has('zip_code'))
                                        <span class="text-danger">{{ $errors->first('zip_code') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="exampleInputEmail1" for="attendee_name_2">Attendee 2
                                        Name</label>
                                    <input type="text" class="form-control" id="exampleInputEmail2"
                                        name="attendee_name_2">
                                    @if ($errors->has('attendee_name_2'))
                                        <span class="text-danger">{{ $errors->first('attendee_name_2') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="exampleInputEmail1" for="attendee_email_2">Attendee 2
                                        Email</label>
                                    <input type="text" class="form-control" id="exampleInputEmail2"
                                        name="attendee_email_2">
                                    @if ($errors->has('attendee_email_2'))
                                        <span class="text-danger">{{ $errors->first('attendee_email_2') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="exampleInputEmail1" for="attendee_name_3">Attendee 3
                                        Name</label>
                                    <input type="text" class="form-control" id="exampleInputEmail2"
                                        name="attendee_name_3">
                                    @if ($errors->has('attendee_name_3'))
                                        <span class="text-danger">{{ $errors->first('attendee_name_3') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="exampleInputEmail1" for="attendee_email_3">Attendee 3
                                        Email</label>
                                    <input type="text" class="form-control" id="exampleInputEmail2"
                                        name="attendee_email_3">
                                    @if ($errors->has('attendee_email_3'))
                                        <span class="text-danger">{{ $errors->first('attendee_email_3') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="exampleInputEmail1" for="attendee_name_4">Attendee 4
                                        Name</label>
                                    <input type="text" class="form-control" id="exampleInputEmail2"
                                        name="attendee_name_4">
                                    @if ($errors->has('attendee_name_4'))
                                        <span class="text-danger">{{ $errors->first('attendee_name_4') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="exampleInputEmail1" for="attendee_email_4">Attendee 4
                                        Email</label>
                                    <input type="text" class="form-control" id="exampleInputEmail2"
                                        name="attendee_email_4">
                                    @if ($errors->has('attendee_email_4'))
                                        <span class="text-danger">{{ $errors->first('attendee_email_4') }}</span>
                                    @endif
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label col-lg-3" for="inputSuccess">Categories</label>
                                    <div class="col-lg-6">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" id="inlineCheckbox1" name="categories[]"
                                                value="gas_station"> Gas Station
                                        </label><br>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" id="inlineCheckbox2" name="categories[]"
                                                value="c_store"> C-Store
                                        </label><br>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" id="inlineCheckbox3" name="categories[]"
                                                value="liquor_store"> Liquor Store
                                        </label><br>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" id="inlineCheckbox3" name="categories[]"
                                                value="smoke_vape_shop"> Smoke Vape
                                            Shop
                                        </label><br>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" id="inlineCheckbox3" name="categories[]"
                                                value="other"> Other
                                        </label><br>
                                    </div>
                                    @if ($errors->has('categories'))
                                        <span class="text-danger">{{ $errors->first('categories') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-info">Submit</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </section>

            </div>
        </div>
    </div>
    </section>
@endsection
@section('datatable')
