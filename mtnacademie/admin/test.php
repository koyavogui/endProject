<?php
    function fact($x) 
    {
        $return = 1;
        for ($i=2; $i <= $x; $i++) {
            $return = gmp_mul($return, $i);
        }
        return $return;
    }
?>