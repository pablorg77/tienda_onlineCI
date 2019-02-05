<?php

function VP($nombreCampo, $valorPorDefecto = '')
        {
            if (isset($_POST[$nombreCampo]))
                return $_POST[$nombreCampo];
            else
                return $valorPorDefecto;
        }