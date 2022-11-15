<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    body{
        font-family:'nunito',sans-serif;
    }
    em{
        font-style:normal;
        color:rgb(38, 38, 124);
        font-weight:bold;
    }
    h1{
        font-size:16px;
        margin-bottom:20px;
    }
    footer{
        margin-top:20px;
    }
    .table-footer {
        width: 40%;
        border: 2px solid #870b26;
    }

    .table-footer td {
        text-align: center;
        height: 76px;
        font-family: 'nunito', sans-serif;
        font-weight: bold;
        color: #870b26;
    }

    .table-footer th {
        width: 230px;
        color: #870b26;
    }
    a img{
        width:24px;
        height:24px;
    }
</style>
<body>

        <h1>Bonjour {{$salarie[0]->name}} ,</h1>

        <p>Votre note de frais pour le mois de <em>{{$moisNDF}}</em> a été validée .</p>
        <p>Pour la consulter en ligne, rendez-vous sur le site de <a href="https://www.carpediem.pro/LesFrais/public/Mes-notes-de-frais">Carpe Diem</a> . </p><br>

        <footer >
            Très cordialement,
        </footer>

        <div class="signature">
            <table class="table-footer">
                <tr>
                    <th><img src="{{ asset('./images/logoCDIT.png') }}" alt="logoCDIT"></th>
                    <th>{{ $moderator[0]->name }}</th>
                </tr>
                <tr>
                    <td style="font-style:italic; height:30px;">assistance@carpediem.pro</td>
                    <td style="font-style:italic; height:30px;">{{ $moderator[0]->email }}</td>
                </tr>

                <tr>
                    <td>
                        <a href="https://www.facebook.com/carpeDiem.itservicestelecom" target="_blank"> <img src="{{ asset('./images/iconFacebook.png') }}" alt="fb"></a>
                        <a href="https://twitter.com/Carpe_Diem_Pro" target="_blank"> <img src="{{ asset('./images/Twitter-b@5x.png') }}" alt="tw"></a>
                        <a href="https://www.linkedin.com/company/carpe-diem-informatique/" target="_blank"> <img src="{{ asset('./images/Linkedin-b@5x.png') }}" alt="ln"></a>
                        <a href="https://www.youtube.com/channel/UCTI2dHTGS9VrwKxGJf5MW7A" target="_blank"> <img src="{{ asset('./images/Youtube-b@5x.png') }}" alt="yt"></a>
                        <a href="https://www.carpediem.pro/" target="_blank"> <img src="{{ asset('./images/Link-b@5x.png') }}" alt="link"></a>
                    </td>
                    <td style="font-size: 10px;">LD : 0170.809.809 - Mob : 06.60.67.33.46</td>
                </tr>
            </table>
        </div>

</body>
</html>
