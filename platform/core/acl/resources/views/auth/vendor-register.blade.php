@extends('core/acl::auth.master-register')

@section('content')
    <h4 class="text-center register-title">{{ trans('core/acl::auth.register_below') }}</h4>
    {!! Form::open(['route' => 'vendor.register.post', 'class' => 'register-form','id'=>'vendor-register']) !!}
    <!-- progressbar -->
    <fieldset id="account-information">
        <div class="fieldset-heading">{{ trans('core/acl::auth.register.account_information') }}:</div>
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="form-group" id="firstNameGroup">
                    <label class="control-label required">{{ trans('core/acl::auth.register.firstname') }}</label>
                    {!! Form::text('first_name', old('first_name', app()->environment('demo') ? 'botble' : null), ['class' => 'form-control form-control-sm', 'placeholder' => trans('core/acl::auth.register.firstname')]) !!}
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group" id="lastNameGroup">
                    <label class="control-label required">{{ trans('core/acl::auth.register.lastname') }}</label>
                    {!! Form::text('last_name', old('last_name', app()->environment('demo') ? 'botble' : null), ['class' => 'form-control form-control-sm', 'placeholder' => trans('core/acl::auth.register.lastname')]) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="form-group" id="emailGroup">
                    <label class="control-label required">{{ trans('core/acl::auth.register.email') }}</label>
                    {!! Form::text('email', old('email', app()->environment('demo') ? 'botble' : null), ['class' => 'form-control form-control-sm', 'placeholder' => trans('core/acl::auth.register.email')]) !!}
                </div>

            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group" id="cnicGroup">
                    <label class="control-label required">{{ trans('core/acl::auth.register.cnic') }}</label>
                    <input type="text" name="cnic" class="cnic form-control form-control-sm" value="{{old('cnic')}}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="form-group" id="phoneGroup">
                    <label class="control-label required">{{ trans('core/acl::auth.register.phone') }}</label>
                    <input type="text" name="phone" class="phone_number_3 form-control form-control-sm"
                           value="{{old('phone')}}" placeholder="{{ trans('core/acl::auth.register.phone') }}">

                </div>

            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group" id="userNameGroup">
                    <label class="control-label required">{{ trans('core/acl::auth.register.username') }}</label>
                    {!! Form::text('username', old('username', app()->environment('demo') ? 'botble' : null), ['class' => 'form-control form-control-sm', 'placeholder' => trans('core/acl::auth.register.username')]) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="form-group" id="passwordGroup">
                    <label class="control-label required">{{ trans('core/acl::auth.login.password') }}</label>
                    {!! Form::input('password', 'password', (app()->environment('demo') ? '159357' : null), ['class' => 'form-control form-control-sm', 'placeholder' => trans('core/acl::auth.login.password')]) !!}
                </div>

            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group" id="confirmPasswordGroup">
                    <label
                        class="control-label required">{{ trans('core/acl::auth.register.confirm_password') }}</label>
                    {!! Form::input('password', 'password_confirmation', (app()->environment('demo') ? '159357' : null), ['class' => 'form-control form-control-sm', 'placeholder' => trans('core/acl::auth.register.confirm_password')]) !!}
                </div>


            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <span  class="form-text text-muted font-12">
                    Your password must be more than 8 characters long, should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character.
                </span>
            </div>
        </div>

        <input type="button" name="next" class="next action-button btn  btn-primary btn-style"
               value="{{ trans('core/acl::auth.register.next') }}"/>
    </fieldset>
    <fieldset id="company-information" style="display:none;">
        <div class="fieldset-heading">{{ trans('core/acl::auth.register.company_information') }}:</div>
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="form-group" id="companyNameGroup">
                    <label class="control-label required">{{ trans('core/acl::auth.register.company_name') }}</label>
                    {!! Form::text('company_name', old('company_name', app()->environment('demo') ? 'botble' : null), ['class' => 'form-control form-control-sm', 'placeholder' => trans('core/acl::auth.register.company_name')]) !!}
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group" id="companyAddressGroup">
                    <label class="control-label required">{{ trans('core/acl::auth.register.company_address') }}</label>
                    {!! Form::text('company_address', old('company_address', app()->environment('demo') ? 'botble' : null), ['class' => 'form-control form-control-sm', 'placeholder' => trans('core/acl::auth.register.company_address')]) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="form-group" id="countryGroup">
                    <label class="control-label required">{{ trans('core/acl::auth.register.country') }}</label>
                    <div class="select--arrow">
                        <select name="country" class="form-control address-control-item" id="country">
                            @foreach(['' => __('Select Country')] + EcommerceHelper::getAvailableCountries() as $countryCode => $countryName)
                                <option @if($countryName === 'Pakistan') selected @endif value="{{ $countryName }}">{{ $countryName }}</option>
                            @endforeach
                        </select>
                        <i class="fas fa-angle-down"></i>
                    </div>
                    {!! Form::error('address.country', $errors) !!}
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group" id="cityGroup">
                    <label class="control-label required">{{ trans('core/acl::auth.register.city') }}</label>
                    <div class="select--arrow">
                        <select name="city" class="form-control address-control-item" id="city">
                            <option value="">Select City</option>
                            @foreach(EcommerceHelper::getAvailableCities() as $cityName=> $cityName)
                                <option value="{{ $cityName }}">{{ $cityName }}</option>
                            @endforeach
                        </select>
                        <i class="fas fa-angle-down"></i>
                    </div>
                </div>
            </div>
            <div class="col-12">
            <div class="form-group" id="aboutCompanyGroup">
                <label class="control-label required">{{ trans('core/acl::auth.register.about_company') }}</label>
                <textarea class="form-control form-control-sm" name="about_company" id="about_company" rows="6"  value="{{old('about_company')}}" placeholder="{{ trans('core/acl::auth.register.about_company') }}" ></textarea>
            </div>
            </div>
        </div>
        <div class="fieldset-heading">{{ trans('core/acl::auth.register.bank_information') }}:</div>
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="form-group" id="bankNameGroup">
                    <label class="control-label">{{ trans('core/acl::auth.register.bank_name') }}</label>
                    {!! Form::text('bank_name', old('bank_name', app()->environment('demo') ? 'botble' : null), ['class' => 'form-control form-control-sm', 'placeholder' => trans('core/acl::auth.register.bank_name')]) !!}
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group" id="accountTitleGroup">
                    <label class="control-label">{{ trans('core/acl::auth.register.account_title') }}</label>
                    {!! Form::text('account_title', old('account_title', app()->environment('demo') ? 'botble' : null), ['class' => 'form-control form-control-sm', 'placeholder' => trans('core/acl::auth.register.account_title')]) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="form-group" id="swiftCodeGroup">
                    <label class="control-label">{{ trans('core/acl::auth.register.swift_code') }}</label>
                    {!! Form::text('swift_code', old('swift_code', app()->environment('demo') ? 'botble' : null), ['class' => 'form-control form-control-sm', 'placeholder' => trans('core/acl::auth.register.swift_code')]) !!}
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group" id="ibanGroup">
                    <label class="control-label">{{ trans('core/acl::auth.register.account_iban') }}</label>
                    {!! Form::text('account_iban', old('account_iban', app()->environment('demo') ? 'botble' : null), ['class' => 'form-control form-control-sm', 'placeholder' => trans('core/acl::auth.register.account_iban')]) !!}
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-block login-button mr-2">
            <span class="signin">{{ trans('core/acl::auth.register.register') }}</span>
        </button>
        <input type="button" name="previous"
               class="previous action-button-previous btn btn-md btn-style"
               value="{{ trans('core/acl::auth.register.previous') }}"/>
    </fieldset>

    <div class="clearfix"></div>

    <br>
    <p><a class="lost-pass-link" href="{{ route('access.password.request') }}"
          title="{{ trans('core/acl::auth.already_have_account') }}">{{ trans('core/acl::auth.already_have_account') }}</a>
    </p>

    {!! apply_filters(BASE_FILTER_AFTER_LOGIN_OR_REGISTER_FORM, null, \Botble\ACL\Models\User::class) !!}

    {!! Form::close() !!}
@stop
@push('footer')
    <script src="{{asset('js/js-validation.js')}}"></script>
    <script src="{{asset('js/phone.js')}}"></script>

    <script>
        var username = document.querySelector('[name="username"]');
        var email = document.querySelector('[name="email"]');
        var firstname = document.querySelector('[name="first_name"]');
        var lastname = document.querySelector('[name="last_name"]');
        var password = document.querySelector('[name="password"]');
        var confirm_password = document.querySelector('[name="password_confirmation"]');
        var company_name = document.querySelector('[name="company_name"]');
        var company_address = document.querySelector('[name="company_address"]');
        var city = document.querySelector('[name="city"]');
        var country = document.querySelector('[name="country"]');
        var phone = document.querySelector('[name="phone"]');
        var cnic = document.querySelector('[name="cnic"]');
        var account_title = document.querySelector('[name="account_title"]');
        var bank_name = document.querySelector('[name="bank_name"]');
        var swift_code = document.querySelector('[name="swift_code"]');
        var account_iban = document.querySelector('[name="account_iban"]');
        var about_company = document.querySelector('[name="about_company"]');

        firstname.focus();
        account_title.addEventListener('focusin', function () {
            document.getElementById('accountTitleGroup').classList.add('focused');
        });
        account_title.addEventListener('focusout', function () {
            document.getElementById('accountTitleGroup').classList.remove('focused');
        });
        about_company.addEventListener('focusin', function () {
            document.getElementById('aboutCompanyGroup').classList.add('focused');
        });
        about_company.addEventListener('focusout', function () {
            document.getElementById('aboutCompanyGroup').classList.remove('focused');
        });
        bank_name.addEventListener('focusin', function () {
            document.getElementById('bankNameGroup').classList.add('focused');
        });
        bank_name.addEventListener('focusout', function () {
            document.getElementById('bankNameGroup').classList.remove('focused');
        });
        swift_code.addEventListener('focusin', function () {
            document.getElementById('swiftCodeGroup').classList.add('focused');
        });
        swift_code.addEventListener('focusout', function () {
            document.getElementById('swiftCodeGroup').classList.remove('focused');
        });
        account_iban.addEventListener('focusin', function () {
            document.getElementById('ibanGroup').classList.add('focused');
        });
        account_iban.addEventListener('focusout', function () {
            document.getElementById('ibanGroup').classList.remove('focused');
        });
        phone.addEventListener('focusin', function () {
            document.getElementById('phoneGroup').classList.add('focused');
        });
        phone.addEventListener('focusout', function () {
            document.getElementById('phoneGroup').classList.remove('focused');
        });
        cnic.addEventListener('focusin', function () {
            document.getElementById('cnicGroup').classList.add('focused');
        });
        cnic.addEventListener('focusout', function () {
            document.getElementById('cnicGroup').classList.remove('focused');
        });
        email.addEventListener('focusin', function () {
            document.getElementById('emailGroup').classList.add('focused');
        });
        email.addEventListener('focusout', function () {
            document.getElementById('emailGroup').classList.remove('focused');
        });
        username.addEventListener('focusin', function () {
            document.getElementById('userNameGroup').classList.add('focused');
        });
        username.addEventListener('focusout', function () {
            document.getElementById('userNameGroup').classList.remove('focused');
        });
        firstname.addEventListener('focusin', function () {
            document.getElementById('firstNameGroup').classList.add('focused');
        });
        firstname.addEventListener('focusout', function () {
            document.getElementById('firstNameGroup').classList.remove('focused');
        });
        lastname.addEventListener('focusin', function () {
            document.getElementById('lastNameGroup').classList.add('focused');
        });
        lastname.addEventListener('focusout', function () {
            document.getElementById('lastNameGroup').classList.remove('focused');
        });
        username.addEventListener('focusin', function () {
            document.getElementById('userNameGroup').classList.add('focused');
        });
        username.addEventListener('focusout', function () {
            document.getElementById('userNameGroup').classList.remove('focused');
        });

        password.addEventListener('focusin', function () {
            document.getElementById('passwordGroup').classList.add('focused');
        });
        password.addEventListener('focusout', function () {
            document.getElementById('passwordGroup').classList.remove('focused');
        });
        confirm_password.addEventListener('focusin', function () {
            document.getElementById('confirmPasswordGroup').classList.add('focused');
        });
        confirm_password.addEventListener('focusout', function () {
            document.getElementById('confirmPasswordGroup').classList.remove('focused');
        });
        company_name.addEventListener('focusin', function () {
            document.getElementById('companyNameGroup').classList.add('focused');
        });
        company_name.addEventListener('focusout', function () {
            document.getElementById('companyNameGroup').classList.remove('focused');
        });
        company_address.addEventListener('focusin', function () {
            document.getElementById('companyAddressGroup').classList.add('focused');
        });
        company_address.addEventListener('focusout', function () {
            document.getElementById('companyAddressGroup').classList.remove('focused');
        });
        city.addEventListener('focusin', function () {
            document.getElementById('cityGroup').classList.add('focused');
        });
        city.addEventListener('focusout', function () {
            document.getElementById('cityGroup').classList.remove('focused');
        });
        country.addEventListener('focusin', function () {
            document.getElementById('countryGroup').classList.add('focused');
        });
        country.addEventListener('focusout', function () {
            document.getElementById('countryGroup').classList.remove('focused');
        });
    </script>
    <script>
        jQuery(document).ready(function () {
            $(window).keydown(function (event) {
                if (event.keyCode === 13) {
                    event.preventDefault();
                    return false;
                }
            });
            $.validator.addMethod("checklower", function (value) {
                return /[a-z]/.test(value);
            });
            $.validator.addMethod("checkupper", function (value) {
                return /[A-Z]/.test(value);
            });
            $.validator.addMethod("checkdigit", function (value) {
                return /[0-9]/.test(value);
            });
            $.validator.addMethod("checkspecialchr", function (value) {
                return /[#?!@$%^&*-]/.test(value);
            });
            var current_fs, next_fs, previous_fs;
            var opacity;
            var current = 1;
            var steps = $("fieldset").length;
            let account_information = $('#account-information');
            let company_information = $('#company-information');


            $(".next").click(function () {
                var form = $("#vendor-register");
                form.validate({
                    errorElement: 'span',
                    errorClass: 'invalid-feedback',

                    errorPlacement: function (error, element) {
                        if (element.parent('.input-group').length ||
                            element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
                            error.insertAfter(element.parent());
                        } else {
                            error.insertAfter(element);
                        }
                    },
                    highlight: function (element) {
                        $(element).closest('.form-control form-control-sm').removeClass('is-valid').addClass('is-invalid');
                    },


                    unhighlight: function (element) {
                        $(element).closest('.form-control form-control-sm').removeClass('is-invalid').addClass('is-valid');
                    },
                    success: function (element) {
                        $(element).closest('.form-control form-control-sm').removeClass('is-invalid').addClass('is-valid');
                    },

                    focusInvalid: false,

                    rules: {
                        "first_name": {"laravelValidation": [["Required", [], "The first name field is required.", true], ["Max", ["60"], "The first name must not be greater than 60 characters.", false], ["Min", ["2"], "The first name must be at least 2 characters.", false]]}
                        ,
                        "phone": {"laravelValidation": [["Required", [], "The phone field is required.", true]]}
                        ,
                        "cnic": {"laravelValidation": [["Required", [], "The CNIC field is required.", true]]}
                        ,
                        "last_name": {"laravelValidation": [["Required", [], "The last name field is required.", true], ["Max", ["60"], "The last name must not be greater than 60 characters.", false], ["Min", ["2"], "The last name must be at least 2 characters.", false]]}
                        ,
                        "email": {
                            "laravelValidation": [["Required", [], "The email field is required.", true], ["Max", ["60"], "The email must not be greater than 60 characters.", false], ["Min", ["6"], "The email must be at least 6 characters.", false], ["Email", [], "The email must be a valid email address.", false]],
                            "laravelValidationRemote": [["Unique", ["email", "eyJpdiI6ImRqLzQ0MDFwdVRuWk1UWkJ3VTRPQ1E9PSIsInZhbHVlIjoiUzMzQ2gxNjhLNElVQVhPY1lxU1RTZmJYM0ZWbENHUlhsZ04vQzE1VzRxeVYycGo4bGtlOGZvNnl5WjU3dTlTOUpNRllCaXh6QTlrc1hRMURzSWhEWnc9PSIsIm1hYyI6ImViOGQyNmY5MTA5OGIyNDE0ZDAyNjVhNjNlYTUzODQ1MWFkZTU3ODI0ZDA0MjAwNTkyOGY3M2VjNGFlZmVjMTcifQ==", false], "The email has already been taken.", false]]
                        },
                        password: {
                            required: true,
                            minlength: 8,
                            maxlength: 20,
                            checklower: true,
                            checkupper: true,
                            checkdigit: true,
                            checkspecialchr: true,
                        },
                        "password_confirmation": {"laravelValidation": [["Required", [], "The password confirmation field is required.", true], ["Same", ["password"], "The password confirmation and password must match.", false]]},
                        "username": {
                            "laravelValidation": [["Required", [], "The username field is required.", true], ["Min", ["4"], "The username must be at least 4 characters.", false], ["Max", ["30"], "The username must not be greater than 30 characters.", false]],
                            "laravelValidationRemote": [["Unique", ["username", "eyJpdiI6ImRqLzQ0MDFwdVRuWk1UWkJ3VTRPQ1E9PSIsInZhbHVlIjoiUzMzQ2gxNjhLNElVQVhPY1lxU1RTZmJYM0ZWbENHUlhsZ04vQzE1VzRxeVYycGo4bGtlOGZvNnl5WjU3dTlTOUpNRllCaXh6QTlrc1hRMURzSWhEWnc9PSIsIm1hYyI6ImViOGQyNmY5MTA5OGIyNDE0ZDAyNjVhNjNlYTUzODQ1MWFkZTU3ODI0ZDA0MjAwNTkyOGY3M2VjNGFlZmVjMTcifQ==", false], "The username has already been taken.", false]]
                        },
                        "company_name": {"laravelValidation": [["Required", [], "The company name field is required.", true]]},
                        "company_address": {"laravelValidation": [["Required", [], "The company address field is required.", true]]},
                        "about_company": {"laravelValidation": [["Required", [], "The about company field is required.", true]]},
                        "city": {"laravelValidation": [["Required", [], "The city field is required.", true]]},
                        "country": {"laravelValidation": [["Required", [], "The country field is required.", true]]},

                    },
                    messages: {
                        password: {
                            pwcheck: "Password is not strong enough",
                            checklower: "Need atleast 1 lowercase alphabet",
                            checkupper: "Need atleast 1 uppercase alphabet",
                            checkdigit: "Need atleast 1 digit",
                            checkspecialchr: "Need atleast 1 special character"
                        },
                    },

                });
                if (form.valid() === true) {
                    current_fs = $(this).parent();
                    next_fs = $(this).parent().next();


                    //show the next fieldset
                    next_fs.show();
                    //hide the current fieldset with style
                    current_fs.animate({opacity: 0}, {
                        step: function (now) {
                            // for making fielset appear animation
                            opacity = 1 - now;

                            current_fs.css({
                                'display': 'none',
                                'position': 'relative'
                            });
                            next_fs.css({'opacity': opacity});
                        },
                        duration: 500
                    });
                }


            });
            $(".previous").click(function () {

                current_fs = $(this).parent();
                previous_fs = $(this).parent().prev();


                //show the previous fieldset
                previous_fs.show();

                //hide the current fieldset with style
                current_fs.animate({opacity: 0}, {
                    step: function (now) {
                        // for making fielset appear animation
                        opacity = 1 - now;

                        current_fs.css({
                            'display': 'none',
                            'position': 'relative'
                        });
                        previous_fs.css({'opacity': opacity});
                    },
                    duration: 500
                });
            });


            $(".submit").click(function () {
                return false;
            })
            // $("#country").on('change',function () {
            //     let value = $('#country').val();
            //     if(value != 'Pakistan'){
            //         $('#city').val()
            //
            //     }
            //
            // })
        });
    </script>

    <script>
        $(document).ready(function () {
            // $('.phone_number').inputmask('(999)-999-9999');
            // $('.phone_number_2').inputmask('(99)-9999-9999');
            $('.phone_number_3').inputmask('03999999999');
            $('.cnic').inputmask('99999-9999999-9')
        });
    </script>
@endpush
