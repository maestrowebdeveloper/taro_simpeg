<?php

foreach ($model as $arr){
    $ss = (isset($arr->Pangkat->Golongan->nama)) ? $arr->Pangkat->Golongan->nama : '-';
    echo $arr->nama . '---' . $ss;
            echo '<br/>';
}
?>