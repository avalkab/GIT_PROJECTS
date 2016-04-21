<!DOCTYPE html>
<html>
<head>
    <title>Sayfa bulunamadi - {project_name} v{project_version}</title>
    <meta charset="utf8">
    <link href='https://fonts.googleapis.com/css?family=Catamaran:400,100,700' rel='stylesheet' type='text/css'></head>
<style type="text/css">
*{
    padding: 0;
    margin: 0;
    font-family: 'Catamaran', sans-serif;
    line-height: 100%;
    font-weight: 400;
}
body{
    background-color: #e1e1e1;
}
.vam{
    position: fixed;
    width: 1000px;
    height: 450px;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    margin: auto;
    text-align: center;
}
.vam h1{
    font-size: 92px;
    font-weight: 100;
    padding-bottom:50px;
}
.vam p{
    font-size: 18px;
    color: #777;
}
.vam small{
    font-size: 13px;
    color: #aaa;
}
#search{
    margin-top: 20px;
    font-size: 16px;
}
#search label{
    font-size: 34px;
    font-weight: 100;
    color: #333;
}
#search_q{
    width: 600px;
    padding:10px;
    font-size: 18px;
    border-radius: 2px;
    border:0;
    outline: 0;
    line-height:19px;
    box-shadow: 0 0 100px 0 #aaa;
}
</style>
<body>

<div class="vam">
<div class="mid">
<h1>404</h1>
<p>İstediğin sayfayı bulamadık, ama üzülme senin için hala birşeyler yapabiliriz!<br><br>Arama kutusunu kullanmaya ne dersin?</p>
<br>
<form id="search" action="http://localhost/dev/mvc/decorator.php?param=arama" method="post">
    <label for="search_q">Bulmak istediğini arama kutusuna yazarak başlayalım!</label>
    <br>
    <br>
    <br>
    <input id="search_q" name="q" type="search" placeholder="Senin için ne yapabilirim?">
</form>
<br>
<small>{project_name} v{project_version}</small>
</div>
</div>

</body>
</html>