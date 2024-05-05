<?php
    
    function checkSum($cardNum)
     {
        $result = 0;
        $i = 0;

        while ($cardNum != 0) {
            $digit = $cardNum % 10;
            if ($i % 2 != 0) {
                $calc_res = $digit * 2;
                if ($calc_res > 9) {
                    $y = $calc_res % 10;
                    $calc_res = intval($calc_res / 10) + $y;
                }
            } else {
                $calc_res = $digit;
            }
            $result += $calc_res;
            $cardNum = intval($cardNum / 10);
            $i++;
        }
        return $result;
    }

    function checkCardNum($total, $cardNum)
{
        $result = "INVALID";
        $length = strlen(strval($cardNum));

        // Check if the total checksum is valid
        if ($total % 10 != 0) {
            return $result;
        }
        // Check the length of the card number and its starting digits
        if (($length == 13 || $length == 15 || $length == 16) &&
            (($length == 13 || $length == 16) && (intval($cardNum / pow(10, $length - 1)) == 4))) {
            $result = "VISA";
        } elseif ($length == 15 && (intval($cardNum / pow(10, $length - 2)) == 34 ||
                intval($cardNum / pow(10, $length - 2)) == 37)) {
            $result = "AMEX";
        } elseif ($length == 16 && intval($cardNum / pow(10, $length - 2)) >= 51 &&
            intval($cardNum / pow(10, $length - 2)) <= 55) {
            $result = "MASTERCARD";
        }

        return $result;
    }


?>