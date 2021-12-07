<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://fonts.googleleapis.com/css?family=PT+Sans+Narrow|Open+Sans:300">
    <title>Timer</title>
    <style>
        body{
            text-align: center;
        }
        .container
        {
			color:white;
            margin-top:-30px;
            position: absolute;
            top:50%;
            left:50%;
            transform: translate(-50%,-50%);
            height: 150px;
            width: 150px;
            border-color :black;
            border-width: 2px;
            border-style: solid;
            border-radius: 50%;
        }
        .container #timer
        {
            position :absolute;
            top:40%;
            left:50%;
            transform: translate(-50%,-50%);
			color:white;
        }
    </style>
</head>
<body>
    <div class = "container">
        <h1 class = "timer" id="timer"></h1>
     </div>
     </body>
<script>
    var seconds=20;
    function displayseconds()
    {
        seconds-=1;
        document.getElementById("timer").innerHTML= ""+seconds+" seconds";
    }
    setInterval(displayseconds,1000);
    function redirectpage()
    {
        alert("Time Over , Hereafter your record won't be accepted");
    }
    setTimeout('redirectpage()',20000);
</script>
</html>