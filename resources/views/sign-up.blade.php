<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sign Up - Lincoln City Portal</title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #2A2A2E;
                color: #222;
                font-family: 'Nunito', sans-serif;
                margin: 0 auto;
            }

            .content {
                background-color: #fff;
                padding: 20px;
            }
            .content h1{
                font-size: 28px;
                font-weight: 600;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row" style="margin-top: 100px; margin-bottom: 50px;">
                <div class="col-md-2">
                    &nbsp;
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col" style="text-align:center;"><a href="{{url('/')}}"><img src="{{ asset('/img/logo.png') }}" alt=""></a></div>
                            </div>
                        </div>
                        <div class="card-body content">
                            <div class="row" style="text-align: center;">
                                <div class="col">
                                    <h1>Lincoln Business Network</h1>
                                    <div>&nbsp;</div>
                                    <h2 style="font-size:24px;">Register for free</h2>
                                </div>
                            </div>
                            <div class="row" style="text-align: center;">
                                <div class="col">
                                    <div>&nbsp;</div>
                                    <em>Referred by:</em> <strong>{{ $res_name ?? "Lincoln City Properties" }}</strong>
                                </div>
                            </div>
                            <div class="row" style="margin-top:20px;">
                                <div class="col">
                                    <!-- Check email availability starts here -->
                                    <form action="" method="get" id="email-check">
                                        @if (count($errors))
                                        <div class="alert alert-danger">
                                            <strong>Whoops!</strong> There are some problems with your input.<br>
                                            <ul>
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                            </ul>
                                        </div>
                                        @endif
                                        @if (isset($suc_msg))
                                        <div class="alert alert-success"><strong>Success!</strong> {{ $suc_msg }} 
                                        <br><a href="{{$ref_link}}" target="_blank">{{ $ref_link }}</a></div>
                                        @endif
                                        @if (isset($err_msg))
                                        <div class="alert alert-warning"><strong>Error!</strong> {{ $err_msg }}</div>
                                        @endif

                                        <div class="form-group">
                                            <input type="email" class="form-control" name="chk-email" id="chk-email" placeholder="Enter email" required>
                                        </div>
                                        <div style="text-align: center;"><button type="submit" class="btn btn-primary" id="chk-email-btn">Check Email Availabilty</button></div>
                                        <!-- Loader and Email Availability message starts here -->
                                        <div id="email-chckin" style="text-align: center; padding: 10px;">
                                            <div><img src="{{ asset('/img/loader2.gif') }}" alt="" style="width:20px;"> Checking email availability...</div>
                                        </div>
                                    </form>

                                    <!-- Main registration starts here -->
                                    <form action="{{ url('/sign-up') }}" method="post" id="signup-form">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="ref_by" value="{{ $res_code ?? '11111111' }}">
                                        <div class="form-group">
                                            <label for="email" style="font-weight:600;">Email:</label>
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Email*" required readonly>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col">
                                                <label for="fname" style="font-weight:600;">Firstname:</label>
                                                <input type="text" class="form-control" name="fname" id="fname" placeholder="Firstname*" required>
                                            </div>
                                            <div class="col">
                                                <label for="lname" style="font-weight:600;">Lastname:</label>
                                                <input type="text" class="form-control" name="lname" id="lname" placeholder="Lastname*" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col">
                                                <label for="gender" style="font-weight:600;">Gender:</label>
                                                <select class="form-control" id="gender" name="gender">
                                                    <option value=""> - - - Select Gender - - - </option>
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                                </select>
                                            </div>
                                            <div class="col">
                                                <label for="dob" style="font-weight:600;">Date of Birth:</label>
                                                <input type="date" class="form-control" name="dob" id="dob" placeholder="Date Of Birth*" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone" style="font-weight:600;">Phone:</label>
                                            <input type="number" class="form-control" name="phone" id="phone" placeholder="Phone*" required>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col">
                                                <label for="state" style="font-weight:600;">State:</label>
                                                <input type="text" class="form-control" name="state" id="state" placeholder="State*" required>
                                            </div>
                                            <div class="col">
                                                <label for="country" style="font-weight:600;">Country:</label>
                                                <input type="text" class="form-control" name="country" id="country" placeholder="Country*" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="acct_name" style="font-weight:600;">Account Name:</label>
                                            <input type="text" class="form-control" name="acct_name" id="acct_name" placeholder="Account Name*" required>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col">
                                                <label for="bank_name" style="font-weight:600;">Bank Name:</label>
                                                <input type="text" class="form-control" name="bank_name" id="bank_name" placeholder="Bank Name*" required>
                                            </div>
                                            <div class="col">
                                                <label for="acct_num" style="font-weight:600;">Account Number:</label>
                                                <input type="number" class="form-control" name="acct_num" id="acct_num" placeholder="Account Number*" required>
                                            </div>
                                        </div>
                                        <div class="row" style="text-align: center;">
                                            <div class="col">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    &nbsp; <input type="hidden" id="chk-email-url" value="{{ url('/') }}">
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function(){
                $('#signup-form').css('display', 'none');
                $('#email-chckin').css('display', 'none');
                //alert($('#chk-email-url').val());
                $('#email-check').submit(function(e){
                    e.preventDefault();
                    var email = $('#chk-email').val();
                    $('#chk-email-btn').attr('disabled');
                    $('#email-chckin').css('display', 'block');
                    $.ajax({
                        type: 'GET',
                        url: $('#chk-email-url').val() + '/checkCust/' + email,
                        success: function(data){
                            if ($.isEmptyObject(data.error)) {
                                alert('Oops! Email not available');
                                //$('#email-chckin').css('display', 'none');
                                $('#chk-email-btn').removeAttr('disabled');
                                var refLink = $('#chk-email-url').val() + '/sign-up/' + data.cust.id + '-' + data.cust.ref_code;
                                $('#email-chckin').html('<p>You already registered. See your referral link below:<br> <a href="'+refLink+'" target="_blank">'+refLink+'</a></p>');
                            } else {
                                alert(data.error);
                                $('#email-check').css('display', 'none');
                                $('#email-chckin').css('display', 'none');
                                $('#signup-form').css('display', 'block');
                                $('#email').val(email);
                            }
                        }
                    });
                });
            });
        </script>
    </body>
</html>
