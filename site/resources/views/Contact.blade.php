@extends('Layout.app')
@section('title','Contact')
@section('content')
<div class="container-fluid jumbotron mt-5 ">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6  text-center">
                <h1 class="page-top-title mt-3">--যোগাযোগ করুন--</h1>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">

        <div class="col-md-6 contact-form">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d922.4294095906671!2d91.7925643515904!3d22.364288077763966!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30acd9027bad6ee9%3A0x49fb343d11b601e0!2sAkbarshah%20Ln%2C%20Chittagong!5e0!3m2!1sen!2sbd!4v1693944867011!5m2!1sen!2sbd"
             width="550" height="380" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

        </div>
        <div class="col-md-6 contact-form">
            <h3 class="service-card-title">ঠিকানা</h3>
                <hr>
                <p class="footer-text"><i class="fas fa-map-marker-alt"></i> আকবরশাহ, চট্টগ্রাম<i class="fas ml-4 fa-phone"></i> ০১৬৮৫৯৬৪০৭৪ <i class="fas ml-4 fa-envelope"></i> swa.ctg@gmail.com</p>
                <hr>
            <div class="form-group ">
                <input id="contactNameId" type="text" class="form-control w-100" placeholder="আপনার নাম">
            </div>
            <div class="form-group">
                <input id="contactMobileId" type="text" class="form-control  w-100" placeholder="মোবাইল নং ">
            </div>
            <div class="form-group">
                <input id="contactEmaild" type="text" class="form-control  w-100" placeholder="ইমেইল ">
            </div>
            <div class="form-group">
                <input id="contactMsgId" type="text" class="form-control  w-100" placeholder="মেসেজ ">
            </div>
            <button id="contactSendBtnId" class="btn btn-block normal-btn w-100">পাঠিয়ে দিন </button>
        </div>
    </div>
</div>



@endsection