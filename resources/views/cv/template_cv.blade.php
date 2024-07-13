<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $name }}'s Resume</title>
    <style>
        @font-face {
            font-family: 'DejaVu Sans';
            src: url('{{ storage_path("fonts/DejaVuSans.ttf") }}') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
        }

        .section {
            margin-bottom: 20px;
        }

        .section h2 {
            border-bottom: 1px solid #000;
            padding-bottom: 5px;
        }

        .footer {
            padding: 10px 0;
            text-align: center;
            width: 100%;
            position: fixed;
            bottom: 20px; /* 50px above the bottom */
            left: 0;
        }
        .footer small a{
            color: #6c757d;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>{{ $name }}</h1>
        <p>{{ $email }} | {{ $phone }} | {{$date_of_birth ? date_format(\Carbon\Carbon::make($date_of_birth),'M d, Y') : ''}} | {{ $address }}</p>
    </div>
    <div class="section">
        <h2>{{ __('cv.education') }}</h2>
        <ul>
            @if(count($education) > 0)
                @foreach($education as $key => $value)
                    <li>
                        <strong>{{ $value }}</strong>
                        <br><small>({{$educ_from_date[$key]}} to {{$educ_to_date[$key]}})</small>
                    </li>
                @endforeach

            @endif
        </ul>
    </div>
    <div class="section">
        <h2>{{ __('cv.experience') }}</h2>
        <ul>
            @if(count($experiences) > 0)
                @foreach($experiences as $key => $value)
                    <li>
                        <strong>{{ $value }}</strong>
                        <br><small>({{$experience_from_date[$key]}} to {{$experience_to_date[$key]}})</small>
                    </li>
                @endforeach

            @endif
        </ul>
    </div>
    <div class="section">
        <h2>{{ __('cv.skills') }}</h2>
        <ul>
            @if(count($skills) > 0)
                @foreach($skills as $key => $value)
                    <li>
                        <strong>{{ $value }}</strong>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
    <div class="section">
        <h2>{{ __('cv.language') }}</h2>
        <ul>
            @if(count($languages) > 0)
                @foreach($languages as $key => $value)
                    <li>
                        <strong>{{ $value }}</strong>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>

    <div class="section">
        <h2>{{ __('cv.additional_info') }}</h2>
        <ul>
            @php
                $yes = __('cv.yes');
                $no = __('cv.no');
            @endphp

            <li>{{ __('cv.include_dl') }}: <b>{{$with_license ? $yes : $no }}</b></li>
            <li>{{ __('cv.own_transport') }}: <b>{{$own_transport ? $yes : $no}}</b></li>
        </ul>
    </div>
    <div class="footer">
        <div style="margin-bottom: 10px; text-align: left !important;">
            <small>{{__('cv.consent')}}</small>
        </div>
        <small><a href="https://jobnl.eu/" style="text-decoration: none;">jobnl.eu</a></small>
    </div>
</div>
</body>
</html>
