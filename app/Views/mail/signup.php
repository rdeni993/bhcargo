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
        <h3>Dobrodošli na BH Cargo servis!</h3>
        <p>
            Drago nam je da ste nakon uspješne registracije postali naš član! 
            Nadamo se da ćete na našem servisu pronaći korisne informacije koje
            će olakšati i unaprijediti Vaše poslovanje!
        </p>
        <p>
            Ovaj E-mail je i svojevrsna potvrda da ste uspješno registrovali svoj 
            nalog na servisu koristeći sljedeće bitne informacije:

            <table>
                <tr>
                    <td><span><small>Ime /</small></span></td>
                    <td><?php echo $name; ?></td>
                </tr>
                <tr>
                    <td><span><small>Prezime /</small></span></td>
                    <td><?php echo $surname; ?></td>
                </tr>
                <tr>
                    <td><span><small>Kompanija /</small></span></td>
                    <td><?php echo $cmp_name; ?></td>
                </tr>
                <tr>
                    <td><span><small>Adresa /</small></span></td>
                    <td><?php echo $cmp_addr; ?></td>
                </tr>
            </table>
        </p>
        <p>
            Podaci kojima ste se prijavili su:
            <table>
                <tr>
                    <td><span><small>Email /</small></span></td>
                    <td><?php echo $email; ?></td>
                </tr>
                <tr>
                    <td><span><small>Lozinka: /</small></span></td>
                    <td><?php echo $password; ?></td>
                </tr>
            </table>
        </p>
        <p>
            Preostalo je još da potvrdite svoj nalog tako što ćete kliknuti na link ispod!<br>
            <a style="display: block;" href="<?php echo base_url('register/activate/'.$email.'/'.$security_hash); ?>">Aktiviraj moj malog</a>
        </p>
        <hr>
        <p>
            U slučaju da ste primili ovaj e-mail a niste se registrovali na našu stranicu kontaktirajte naše administratore da 
            uklone Vaš račun!
        </p>
        <p>
            U slučaju da ovaj e-mail koristi više ljudi a ne samo Vi poželjno bi bilo da ga sačuvate na neko sigurno mjesto
            i osigurate da niko ne vidi Vaše podatke za prijavljivanje. U slučaju da se ne možete prijaviti na naš servis koristeći 
            podatke iz E-maila kontaktirajte naše administratore!
        </p>
        <p><i>Poštovanje,<br>BH Cargo tim</i></p>
    </div>
</body>
</html>