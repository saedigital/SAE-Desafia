<!--
@Author (Não Sei KKK)

https://codepen.io/linux/full/OjmeKP/
https://codepen.io/linux/pen/OjmeKP
-->
<!DOCTYPE html>
<html lang="{$FastApp->getConfig("lang")}">
<head>
    <meta charset="UTF-8">
    <title>{$Lang->line("error404")}</title>
</head>
<body>
    <div class="container">
        <div  class="error">
            <p class="p">4</p>
            <span class="dracula">
                <div class="con">
                    <div class="hair"></div>
                    <div class="hair-r"></div>
                    <div class="head"></div>
                    <div class="eye"></div>
                    <div class="eye eye-r"></div>
                    <div class="mouth"></div>
                    <div class="blod"></div>
                    <div class="blod blod2"></div>
                </div>
            </span>
            <p class="p">4</p>

            <div class="page-ms">
                <p class="page-msg"> {$Lang->line("error404")} </p>
                <a href="{base_url($FastApp->getConfig("default_route"))}"><button class="go-back">{$Lang->line("error404_btn")}</button></a>
            </div>
        </div>
    </div>
    <style scoped>
        .dracula,.error .p{ display:inline-block }.mouth::after,.mouth::before{ border-left:5px solid transparent;border-right:5px solid transparent;border-top:13px solid #FFF }.eye,button.go-back{ transition:.3s linear }*{ padding:0;margin:0;box-sizing:border-box }::after,::before{ content:'';position:absolute }body{ background:fixed #1B0034;background-image:linear-gradient(135deg,#1B0034 10%,#33265C 100%);background-size:cover }.error{ width:100%;height:auto;margin:50px auto 0;text-align:center }.dracula{ width:230px;height:300px;margin:auto;overflowX:hidden }.error .p{ color:#C0D7DD;font-size:280px;margin:50px;font-family:Anton,sans-serif;font-family:Comfortaa,cursive;font-family:Combo,cursive }.error p.page-msg,button.go-back{ font-size:30px;font-family:Combo,cursive }.con{ width:500px;height:500px;position:relative;margin:9% auto 0;animation:ani9 .7s ease-in-out infinite alternate }.hair,.hair-r{ width:210px;background:#33265C }@keyframes ani9{ 0%{ transform:translateY(10px) }100%{ transform:translateY(30px) } }.hair,.hair-r,.head{ height:200px;border-radius:0 50%;transform:rotate(45deg) }.con>*{ position:absolute;top:0;left:0 }.hair{ top:-20px }.hair-r{ left:20px }.head{ width:200px;background:#C0D7DD }.eye{ width:20px;height:20px;background:#111113;border-radius:50%;top:15%;left:11.5% }.blod,.mouth{ height:20px;background:#840021 }.eye-r{ left:24% }.mouth{ width:60px;top:20%;left:14%;border-radius:50%/0 0 100% 100% }.blod,.blod::after{ border-radius:20px }.mouth::after{ left:10px }.mouth::before{ left:40px }.blod{ width:8px;top:23%;left:17% }.blod::after{ width:2px;height:10px;background:#FFF;top:20%;left:10% }.blod2{ top:23%;left:20%;width:13px;height:13px;border-radius:50% 50% 50% 0;transform:rotate(130deg);animation:blod 2s linear infinite;opacity:0 }@keyframes blod{ 0%{ opacity:1 }100%{ background:red;opacity:0;top:50% } }.page-ms{ transform:translateY(-50px) }.error p.page-msg{ text-align:center;color:#C0D7DD;margin-bottom:20px }button.go-back{ border:none;padding:10px 20px;cursor:pointer;z-index:9;border-radius:10px;background:#C0D7DD;color:#33265C;box-shadow:0 0 10px 0 #C0D7DD;margin-top:20px }button:hover{ box-shadow:0 0 20px 0 #C0D7DD }
    </style>
</body>
</html>
