<!DOCTYPE html>
<html>
<head>
    <title>Mkataba wa Pikipiki</title>

    <style>
        body {
            background: #dcdcdc;
            font-family: "Times New Roman", serif;
        }

        .page {
            width: 210mm;
            min-height: 297mm;
            margin: 20px auto;
            background: #fff;
            padding: 50px 45px;
            box-shadow: 0 0 12px rgba(0,0,0,0.2);
        }

        .title {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            letter-spacing: 1px;
            text-transform: uppercase;
            border-bottom: 2px solid black;
            padding-bottom: 5px;
            margin-bottom: 25px;
        }

        .text {
            font-size: 15px;
            line-height: 1.8;
            text-align: justify;
        }

        .line {
            display: inline-block;
            border-bottom: 1px dotted #000;
            min-width: 220px;
            height: 14px;
        }

        .line-short {
            min-width: 120px;
        }

        .section {
            margin-top: 12px;
        }

        .number {
            margin-top: 10px;
        }

        .signatures {
            margin-top: 50px;
            font-size: 14px;
        }

        .sign-row {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .sign-box {
            width: 30%;
            text-align: center;
        }

        .sign-line {
            margin-top: 40px;
            border-top: 1px solid #000;
        }

        .footer {
            margin-top: 40px;
            font-size: 14px;
        }

        @media print {
            body {
                background: white;
            }

            .page {
                margin: 0;
                box-shadow: none;
                width: 100%;
            }
        }
    </style>
</head>

<body>

<div class="page">

    <div class="title">MKATABA WA MAKABIDHIANO YA PIKIPIKI</div>

    <div class="text">
        Mimi <span class="line">{{ $contract->driver->driver_name }}</span>
        nimemkabidhi pikipiki yangu bw/bw
        <span class="line line-short"></span>
        aina ya <span class="line line-short"></span>
        yenye namba za usajili
        <span class="line">{{ $contract->motorbike->motorbike_id }}</span>
        leo tarehe
        <span class="line line-short">{{ date('d/m/Y') }}</span>
        kwa makubaliano yafuatayo:
    </div>

    <div class="text number">
        1. Bw/Bi <span class="line">{{ $contract->driver->driver_name }}</span>
        anatakiwa kuwasilisha kiasi cha Tsh <span class="line line-short"></span>.
        Kwa siku ambapo anatakiwa kuwasilisha kwa wiki Tsh
        <span class="line line-short"></span>
        na mkataba utaisha tarehe
        <span class="line line-short"></span>.
    </div>

    <div class="text number">
        2. Bw/Bi <span class="line">{{ $contract->driver->driver_name }}</span>
        atahusika na matengenezo yote ya pikipiki kwa muda wote wa mkataba huu
        na kuleta pesa kamili kama mkataba unavyosema.
    </div>

    <div class="text number">
        3. Endapo atamaliza malipo haya kwa muda tuliokubaliana bila matatizo
        atakabidhiwa kadi ya pikipiki kwa mali yake halali kuanzia hapo.
    </div>

    <div class="text number">
        4. Anatakiwa kutoa taarifa kama itatokea dharura yeyote na kukubaliana
        kwa pamoja juu ya malipo.
    </div>

    <div class="text number">
        5. Endapo atashindwa kutimiza masharti ya mkataba huu atavunja
        mkataba mwenyewe na nitachukua pikipiki yangu.
    </div>

    <div class="text number">
        6. Endapo mimi mmiliki wa pikipiki nitavunja mkataba huu nitatakiwa
        kurudisha pesa zote za matengenezo aliyotumia kutengeneza wakati anaendesha.
    </div>

    <div class="text number">
        7. Nimemkabidhi pikipiki iliyo katika hali nzuri ambayo haina tatizo
        lolote la kiufundi na kwa kusaini mkataba huu amekubaliana na masharti yote.
    </div>

    <!-- SIGNATURES -->
    <div class="signatures">

        <div class="sign-row">
            <div class="sign-box">
                SAHIHI YA MWENYE PIKIPIKI<br>
                SIMU: {{ $driver->sponsor_phone }}
                <div class="sign-line"></div>
            </div>

            <div class="sign-box">
                SAHIHI YA MKABIDHIWA<br>
                SIMU: {{ $driver->driver_phone }}
                <div class="sign-line"></div>
            </div>

            <div class="sign-box">
                SAHIHI YA MDHAMINI<br>
                {{ $driver->sponsor_name }}
                <div class="sign-line"></div>
            </div>
        </div>

        <div class="sign-row">
            <div class="sign-box">
                SHAHIDI WA MMILIKI
                <div class="sign-line"></div>
            </div>

            <div class="sign-box">
                SHAHIDI WA MKABIDHIWA
                <div class="sign-line"></div>
            </div>

            <div class="sign-box">
                AFISA MTAA
                <div class="sign-line"></div>
            </div>
        </div>

    </div>

    <!-- FOOTER -->
    <div class="footer">
        MKATABA HUU UMESHUHUDIWA NA OFISI YA SERIKALI YA MTAA WA WAZO
        <br><br>
        ________________________________
        <br>
        AFISA MTENDAJI / MWENYEKITI / MJUMBE
    </div>

</div>

<script>
    window.print();
</script>

</body>
</html>