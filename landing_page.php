<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page Mart Baiturrahman</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <section>
        <div class="circle"></div>
        <header>
            <a href="img"><img src="Logo.png" class="logo"></a>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Login</a></li>
            </ul>
        </header>
        <div class="content">
            <div class="TextBox">
                <h2>MART<br> <span>BAITURRAHMAN</span></h2>
                <p>MARKET BASKET ANALYSIS MENGGUNAKAN ALGORITMA APRIORI DAN CMAR PADA MART BAITURRAHMAN.</p>
                <a href="#">Learn More</a>
            </div>
            <div class="imgBox">
                <img src="img1.png" class="market">
            </div>
        </div>
        <ul class="thumb">
            <li><img src="thumb1.png" onclick="imgSlider('img1.png');changeCircleColor('#017143')"></li>
            <li><img src="thumb2.png" onclick="imgSlider('img2.png');changeCircleColor('#eb7495')"></li>
            <li><img src="thumb3.png" onclick="imgSlider('img3.png');changeCircleColor('#d752b1')"></li>
        </ul>
        <ul class="sci">
            <li><a href="#"><img src="instagram.png"></a></li>
            <li><a href="#"><img src="facebook.png"></a></li>
        </ul>
    </section>

    <script type="text/javascript">
        function imgSlider(anything){
            document.querySelector('.market').src = anything;
        }

        function changeCircleColor(color){
            const circle = document.querySelector('.circle');
            circle.style.background = color;
        }
    </script>
</body>

</html>