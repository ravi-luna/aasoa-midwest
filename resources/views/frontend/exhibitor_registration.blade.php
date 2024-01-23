@extends('frontend.include.layout')
@section('content')
    <div class="form-w3layouts">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Exhibitor Registration
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <form method="post" enctype="multipart/form-data" action="{{ route('validate_exhibitor') }}">
                                @csrf
                                <div class="form-group">
                                    <label class="exampleInputEmail1" for="contact_name">Contact Name</label>
                                    <input type="text" class="form-control" id="exampleInputEmail2" name="contact_name">
                                    @if ($errors->has('contact_name'))
                                        <span class="text-danger">{{ $errors->first('contact_name') }}</span>
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
                                    <label class="exampleInputEmail1" for="contact_email">Email</label>
                                    <input type="email" class="form-control" id="exampleInputEmail2" name="contact_email">
                                    @if ($errors->has('contact_email'))
                                        <span class="text-danger">{{ $errors->first('contact_email') }}</span>
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
                                            <option value="{{ $stateId }}">{{ $stateName }}</option>
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

                                <div class="form-group row">
                                    <label class="col-sm-3 control-label col-lg-3" for="inputSuccess">Electricity
                                        Required</label>
                                    <div class="col-lg-6">
                                        <label class="checkbox-inline">
                                            <input type="radio" id="inlineCheckbox1" name="electricity[]" value="yes"
                                                checked> Yes
                                        </label><br>
                                        <label class="checkbox-inline">
                                            <input type="radio" id="inlineCheckbox2" name="electricity[]" value="no">
                                            No
                                        </label><br>
                                    </div>
                                    @if ($errors->has('electricity.*'))
                                        <span class="text-danger">{{ $errors->first('electricity.*') }}</span>
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
