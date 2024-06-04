<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$data['title']}}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<style>
    .header-logo{
        position: relative;
    }
    .logo{
        position: absolute;
        left: 50%;
        transform: translate(-50%, 0);
        width: 20%;
        height: 13%;
    }
    .text-content{
        position: absolute;
        top: 13.5%;
        width: 50%;
        left: 50%;
        transform: translate(-50%, 0);
    }
    .body-content{
        position: absolute;
        top: 27%;
    }

    .body-content > h1{
        font-weight: bold;
        font-size: 1.4rem;
    }
    hr{
        border: 1px solid #168753;
    }
    span{
        text-transform: capitalize;
    }
</style>

<body>
    <div class="header-content">
        <div class="header-logo w-100">
            <img src="images/nolitc.png" alt="nolitc logo" class="logo">
        </div>
        <div class="text-center text-content">
            NEGROS OCCIDENTAL LANGUAGE AND INFORMATION TECHNOLOGY CENTER
        </div>
    </div>

    <div class="body-content w-100">
        <h1>LEARNERS PROFILE FORM</h1>
        <hr>
        <div class="data-content">
            <p class="w-50">Full name: <span>{{$data['student']->fname." ".$data['student']->lname}}</span></p>
            <p class="w-50">Nationality: <span>{{$data['student']->nationality}}</span></p>
        </div>

    </div>

</body>
</html>
