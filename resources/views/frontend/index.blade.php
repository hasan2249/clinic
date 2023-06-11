@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@section('content')
<div class="step-app" id="demo">
    <ul class="step-steps">
        <li data-step-target="step1">Mobile number verification</li>
        <li data-step-target="step2">Passport Info</li>
        <li data-step-target="step3">Accommodation</li>
        <li data-step-target="step3">Privew</li>
    </ul>
    <div class="step-content">
        <div class="step-tab-panel" data-step="step1">
            <h3>Mobile number verification</h3>
            <form name="mobile" id="mobile">
                Mobile number:<br>
                <input type="text" name="txtFirstName">
                <br> OTP Code:<br>
                <input type="text" name="txtLastName" maxlength="4">
            </form>
        </div>
        <div class="step-tab-panel" data-step="step2">
            <h3>Passport Info</h3>
            <form name="passport" id="passport">
                <div id="passport_div">
                    First name:<br>
                    <input type="text" name="firstName[]">
                    <br> Last name:<br>
                    <input type="text" name="lastName[]">
                    <br> Birthday:<br>
                    <input type="date" name="birthday[]" id="birthday-date" max="{{date('Y-m-d')}}">
                    <br> Gender:<br>
                    <label for="male">Male</label>
                    <input type="radio" name="gender[0]" value="male" id="male" checked>
                    <label for="female">Female</label>
                    <input type="radio" name="gender[0]" value="female" id="female">
                    <br> Place of birth:<br>
                    <div class="form-item">
                        <input id="country_selector" class="country" name="country[]" type="text">
                        <label for="country_selector" style="display:none;">Select a country here...</label>
                    </div>
                    <br> Passport number:<br>
                    <input type="text" name="passport_number[]" min="6" pattern="[a-zA-Z0-9]">
                    <br> Issue date:<br>
                    <input type="date" name="issue_date[]" id="issue-date">
                    <br> Expire date:<br>
                    <input type="date" name="expire_date[]" id="expire-date" min="{{date('Y-m-d')}}">
                    <br> Place of issue:<br>
                    <div class="form-item country">
                        <input id="country_selector_" class="country" name="place_of_issue[]" type="text">
                        <label for="country_selector_" style="display:none;">Select a country here...</label>
                    </div>
                    <br> Arrival date:<br>
                    <input type="date" name="arrival_date[]" id="arrival-date" min="{{date('Y-m-d')}}">
                    <br> Profession:<br>
                    <input type="text" name="profession[]">
                    <br>Organisation:<br>
                    <input type="text" name="organisation[]">
                    <br>Visa Duration:<br>
                    <input type="number" name="organisation[]" min="1" max="90">
                    <br>Organisation:<br>
                    <input type="text" name="organisation[]">
                    <br> Visa Status:<br>
                    <label for="single">Single</label>
                    <input type="radio" name="visa_status[0]" value="single" id="single" checked>
                    <label for="multiple">Multiple</label>
                    <input type="radio" name="visa_status[0]" value="multiple" id="multiple">
                    <br>Upload files:<br>
                    <label>passport picture</label>
                    <input type="file" name="pa_pic[]">
                    <label>personal picture</label>
                    <input type="file" name="pers_pic[]">
                    <hr />
                </div>
                <div id="add"></div>
                <button id="add-person">Add more companion</button>
            </form>
        </div>
        <div class="step-tab-panel" data-step="step3">
            <h3>Accommodation preference</h3>
            <form name="accommodation" id="accommodation">
                <h3>eligible stay</h3>
                check in date:<br>
                <input type="date" name="check_in" id="check-in-date" min="{{date('Y-m-d')}}">
                <br />check out date:<br>
                <input type="date" name="check_in" id="check-in-date" min="{{date('Y-m-d')}}" max="{{date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') + 5, date('Y')))}}">
                <br> Room type:<br>
                <label for="king_bed_1">King bed</label>
                <input type="radio" name="room_1" value="king_bed_1" id="king_bed_1">
                <label for="twin_bed_1">Twin bed</label>
                <input type="radio" name="room_1" value="twin_bed_1" id="twin_bed_1">
                <h3>Extra night</h3>
                check in date:<br>
                <input type="date" name="check_in" id="check-in-date" min="{{date('Y-m-d')}}">
                <br />check out date:<br>
                <input type="date" name="check_in" id="check-in-date" min="{{date('Y-m-d')}}">
                <br> Room type:<br>
                <label for="king_bed_2">King bed</label>
                <input type="radio" name="room_2" value="king_bed_2" id="king_bed_2">
                <label for="twin_bed_2">Twin bed</label>
                <input type="radio" name="room_2" value="twin_bed_2" id="twin_bed_2">
            </form>
        </div>
        <div class="step-tab-panel" data-step="step3">
            <h3>Preview</h3>
        </div>
    </div>
    <div class="step-footer">
        <button data-step-action="prev" class="step-btn">Previous</button>
        <button data-step-action="next" class="step-btn">Next</button>
        <input data-step-action="finish" class="step-btn" type="submit" value="Submit">
        <!-- <button data-step-action="finish" class="step-btn">Finish</button> -->
    </div>
</div>


@endsection