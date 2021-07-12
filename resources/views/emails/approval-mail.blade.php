<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;300;400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: \'Noto Sans JP\', sans-serif;
            font-size: 12px;
        }

        .email-table {
            width: 100%;
            border-collapse: collapse;
            white-space: nowrap;
            font-size: 12px;
        }

        .email-table tr th {
            padding: 5px;
            text-align: left;
        }

        .email-table tr td {
            padding: 5px;
            text-align: left;
        }

        .email-table td,
        .email-table th {
            border: 1px solid black;
        }


            </style>
        </head>
    <body>
    <a href="{{env('MYHUB_URL')}}"> <img src="https://myhub.atp.ph/resource/style1/img/myhublogo.png" width="280" /></a>
        <div class="body-content container">
            @if ($action == 1)
            Hi {{ $superior }},
            <br><br>
            {{ $name }} has filed a <b> @if ($mode == 4) Manual Log @else Selfie @endif </b> using <b>MyHUB : Check IN/OUT</b>

            @elseif ($action == 2)
            Hi {{ $name }},
            <br><br>
            You have filed a <b> @if ($mode == 4) Manual Log @else Selfie @endif </b> using <b>MyHUB : Check IN/OUT</b>

            @elseif ($action == 3)
            Hi {{ $superior }},
            <br><br>
            You <b>@if($status == 1) Approved @else Declined @endif </b> the requested <b> @if ($mode == 4) Manual Log @else Selfie @endif </b> of {{ $name }}

            @elseif ($action == 4)
            Hi {{ $name }},
            <br><br>
            {{ $superior }} has <b>@if($status == 1) Approved @else Declined @endif </b> your requested <b> @if ($mode == 4) Manual Log @else Selfie @endif </b>

            @endif
            <br><br>
            <table class="email-table" border="1" cellspacing=0>
                <thead>
                    <tr>
                        <th>Employee</th>
                        <th>Location</th>
                        <th>Type</th>
                        <th>TimeLog</th>
                        @if ($action <= 2 && $mode == 4)
                            <th>Reason</th>
                        @elseif($action >=3)
                            <th>Remarks</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $name }}</td>
                        <td>{{ $location }}</td>
                        <td>@if($type = 1) IN @else OUT @endif</td>
                        <td>{{ $time }}</td>
                        @if ($action <= 2 && $mode == 4)
                        <td>{{ $reason }}</td>
                        @elseif($action >=3)
                        <td>{{ $remarks }}</td>
                        @endif
                    </tr>
                </tbody>
            </table>
         </div>
         @php
         $redirect    = base64_encode(env('APP_URL'));
         if($action == 2 || $action == 4)
         {
            $subredirect = base64_encode(env('APP_URL').'/logsheet');
         }
         else
         {
            $subredirect = base64_encode(env('APP_URL').'/approval');
         }
         @endphp
        <p> Visit <a href="{{env('MYHUB_URL')}}/?redirect={{$redirect}}&&sub-redirect={{$subredirect}}">MyHub : Check IN/OUT</a> for more details.</p>
    </body>
</html>
