<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .card span{
            font-size: 13px !important;
        }
        .card .data-info{
            font-weight: bold;
        }
        .sub-title{
            max-width: 400px; 
            padding-top:10px; 
            margin-left:0.2rem; 
            margin: 30px auto 15px auto;
            font-size: 14px;
            color: #333;
        }
        .deskripsi{
            max-width: 700px;
            font-size: 14px;
            text-align: justify;
            margin: 0 auto;
        }
        .card table{
            width: 100%;
            border-collapse: collapse;
        }
        .card table tr td{
            padding-bottom: 8px;
        }
    </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Omni Assessment</title>
</head>


<body style="font-family: 'Poppins', sans-serif; margin:0 0 4rem 0; background-color: #f3f3f3">
    <div style="height: 2rem; padding:1% 1rem 0 1rem; color:grey; font-size:10px;">
        <div style="float: right;">
            <div style="text-align: right;">
                <b> {{date('d F Y')}}</b>
                <br>
                <b>{{date('g:i a')}}</b>
            </div>
        </div>
        <div style="float: left;">
            <p></p>
            <div style="text-align:left">
                <b>{{isset($title) ? $title : ''}}</b>
            </div>
        </div>
    </div>
    <div style="
        text-align: center;
        background: #F8495C;
        padding: 50px 10px;
    ">
            <img src="{{url('/image/Logo.jpg')}}" alt="omni assessment" style="
                height: 3.5rem;
                object-fit: cover;
            ">
    </div>

    <div style="
        margin:auto 8vw 2rem 8vw;
        position: relative;
    ">
        <div style="
            background-color: white;
            padding: 10px 20px;
            margin-top: 25px;
        ">
            <div style="
                max-width: 600px; 
                width:100%; 
                margin: 25px auto 0 auto;
            ">
            <!-- ================ -->
            <!-- Body Email       -->
            <!-- ================ -->
                        <h3 style="text-align: center;">{{$subject}}</h3>
                        <p style="margin-bottom: 25px;" class="deskripsi">
                            {{$deskripsi}}
                        </p>
                        <p class="deskripsi" style="margin-top: 25px;">
                    
                        </p>
             <!-- ================ -->
            <!-- End Body Email       -->
            <!-- ================ -->
                <table style="width: 100%; background:white" >
                    <tr style="text-align: center">
                        <td>
                            <a href="{{isset($url) ? $url : '#'}}" style="
                                border: none;
                                color: white;
                                padding: 15px 0;
                                text-align: center;
                                display: inline-block;
                                font-size: 16px;
                                width:100%;
                                cursor: pointer;
                                background: #F8495C;
                                text-decoration:none
                            ">
                              Lihat Selengkapnya
                            </a>        
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style="font-size:13px;">
                               atau kunjungi tautan berikut
                                <br>
                                @if(isset($url))
                                <a href="{{ $url }}">
                                    <i>
                                        {{ $url }}
                                    </i>
                                </a>
                                @endif
                            </p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

</body>

</html>
