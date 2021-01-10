<!DOCTYPE html>
<html>
<head>
    <title>Rdeni</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
        .mail-content{
            width: 600px;
            margin: auto;
            font-family: sans-serif;
            color: #333;
        }
        .mail-content p{
            margin: 18px 0;
            font-size: .9em;
        }
        .mail-content h3{
            color: #000;
        }
        .mail-content table td:first-child{
            color: #aaa;
        }
        .mail-content table{
            margin: 50px 0;
        }
        .mail-content img{
            text-decoration: none;
            color: #000;
            vertical-align: middle;
            margin-right: auto;
        }
        .mail-content a{
            text-decoration: none;
            color: #000;
            vertical-align: middle;
            margin-right: 0px;
            padding:15px;
            border: 1px solid #c1c1c1;
            border-radius: 12px;
        }
        .mail-content a:hover{
            text-decoration: none;
            color: #000;
        }
        .mail-header{
            display: flex;
            justify-content: space-between!important;
            padding: 20px 0;
            border-bottom: 1px solid #c1c1c1;
        }
    </style>
</head>
<body>
    <div class="mail-content">
        <div class="mail-header">
            <img src="<?php echo base_url('public/assets/img/logo-2.png'); ?>" alt="">
            <a href="<?php echo base_url('login') ?>">Prijavi se</a>
        </div>
        <h3>Zatražili ste resetovanje lozinke!</h3>
        <p>Pozdrav,</p>
        <p>Naš automatski servis zaprimio je Vaš zahtjev za resetovanjem lozinke!</p>
        <p>U slučaju da ste sačuvali e-mail poslat nakon registracije možete pogledati vaše 
        podatke koje ste koristili za izradu naloga!</p>
        <p>Ako Ipak želite resetovanje lozinke molimo vas da kliknete na link ispod!</p><br>
        <a style="display:block;" href="<?php echo base_url('reset/reset?_m='.$ema.'&_h=' . $sec); ?>">Zamjeni lozinku</a>
        </p>
        <p><i>Poštovanje,<br>BH Cargo tim</i></p>
    </div>
</body>
</html>