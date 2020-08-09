<?php namespace App\Classes;

class ExportExcel{

    function to_xls($data, $filename){
        $fp = fopen($filename, "w+");
        $str = pack(str_repeat("s", 6), 0x809, 0x8, 0x0, 0x10, 0x0, 0x0); // s | v
        fwrite($fp, $str);
        if (is_array($data) && !empty($data)){
            $row = 0;
            foreach (array_values($data) as $_data){
                if (is_array($_data) && !empty($_data)){
                    if ($row == 0){
                        foreach (array_keys($_data) as $col => $val){
                            $this->_xlsWriteCell($row, $col, $val, $fp);
                        }
                        $row++;
                    }
                    foreach (array_values($_data) as $col => $val){
                        $this->_xlsWriteCell($row, $col, $val, $fp);
                    }
                    $row++;
                }
            }
        }
        $str = pack(str_repeat("s", 2), 0x0A, 0x00);
        fwrite($fp, $str);
        fclose($fp);
    }


    function _xlsWriteCell($row, $col, $val, $fp){
        $form_val = iconv('UTF-8', 'ASCII//TRANSLIT', $val);
        if (is_float($form_val) || is_int($form_val)){
            $str  = pack(str_repeat("s", 5), 0x203, 14, $row, $col, 0x0);
            $str .= pack("d", $form_val);
        } else {
            $l    = strlen($form_val);
            $str  = pack(str_repeat("s", 6), 0x204, 8 + $l, $row, $col, 0x0, $l);
            $str .= $form_val;
        }
        fwrite($fp, $str);
    }

}