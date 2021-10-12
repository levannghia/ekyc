<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="shortcut icon" type="image/x-icon" href="/public/sites/images/logo-kyc.png">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/public/sites/css/style.css?v={{time()}}">
    <script type="text/javascript" src="https://unpkg.com/webcam-easy/dist/webcam-easy.min.js"></script>
</head>

<body>
    <div class="container">
    @include('Sites::inc.header')

    @yield('content')

    {{-- @include('Sites::inc.footer') --}}

    </div>
    <script type="text/javascript" src="https://unpkg.com/webcam-easy/dist/webcam-easy.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            let webCamElement = document.getElementById("camera");
            let canvasElement = document.getElementById("canvas");
            const snapSoundElement = document.getElementById('snapSound');
            const webcam = new Webcam(webCamElement, 'user', canvasElement, snapSoundElement);
            const checker = document.querySelector('#checker');
            const photo = document.querySelector('.photo');
            const tryIt = document.querySelector('#try');
            //$('#camera').style.display="none";
            //$('#camera').attr('visibility', 'hidden');
            //$('#camera').attr('display', 'block');

            // $('#camera').css('visibility', 'hidden');
            $('#take-photo').click(function() {
                webcam.start();
                this.style.display = 'none';
                photo.style.display = 'block';
                webCamElement.style.display = 'block';
                canvasElement.style.display = 'block';
                webCamElement.style.zIndex = '10';
                canvasElement.style.zIndex = '-1';
                checker.style.display = 'block';

            });

            $('#try').click(function() {
                this.style.display = 'none';
                checker.style.display = 'block';
                webCamElement.style.zIndex = '10';
                canvasElement.style.zIndex = '-1';
            })

            $('#checker').click(function() {
                this.style.display = 'none';
                webCamElement.style.zIndex = '-1';
                canvasElement.style.zIndex = '10';
                tryIt.style.display = 'block';
                picture = webcam.snap();
                document.querySelector('#download-photo').src = picture;
                document.querySelector('#download-photo').value = picture;
                $.post('TestCamera', {
                    param: picture
                }, function(response) {
                    if (response === 'error') {
                        alert('Error you should stay in front of camera');
                    } else {
                        window.location.replace('QuestionAndAnalyze.jsp'); /* redirect*/
                    }
                }); /*END servletCall*/
            }); /*END click*/

        }); /* END ready*/
    </script>
    <script src="/public/sites/js/script.js"></script>

</body>
