<?php

class Form
{
    static function input($type,$name,$attribute = [])
    {
        $attr = '';
        $vals = isset($attribute['value']) ? $attribute['value'] : '';
        if($type == 'date' && !isset($attribute['value'])) $attribute['value'] = date('Y-m-d');
        foreach($attribute as $key => $value)
            $attr .= " $key='$value'";
        
        if($type == 'textarea')
        {
            return self::textarea($name, $vals, $attr);
        }

        $lists = "";
        if(substr($type,0,7) == 'options')
        {
            $multiple = false;
            if(stringContains($type, 'multiple'))
            {
                $multiple = true;
                $attr .= " multiple";
                $name .= "[]";
            }
            $types = explode(':',$type);
            $options = $types[1];
            
            if(substr($type, 8,3) == 'obj')
            {
                $obj_array = explode(',',$options);
                $options = $obj_array[0];

                $conn = conn();
                $db   = new Database($conn);
                $datas = $db->all($options);
                $options = $datas;
                $lists .= "<option value=''>- Pilih -</option>";
                foreach($options as $option)
                {
                    $lists .= "<option value='".$option->{$obj_array[1]}."' ".(
                        ($multiple && stringContains($value,$option->{$obj_array[1]})) || ($option->{$obj_array[1]}==$value)?'selected=""':''
                    ).">".$option->{$obj_array[2]}."</option>";
                }
            }
            else
            {
                $options = explode('|',$options);
                foreach($options as $option)
                    $lists .= "<option value='$option' ".($option==$value?'selected=""':'').">$option</option>";
            }
            
            return self::options($name, $lists, $attr);
        }

        return self::text($type,$name,$attr);
    }

    static function text($type,$name, $attr = "")
    {
        return "<input type='$type' name='$name' $attr>";
    }

    static function textarea($name, $value, $attr = "")
    {
        return "<textarea name='$name' $attr>$value</textarea>";
    }

    static function options($name, $lists, $attr = "")
    {
        return "<select name='$name' $attr>$lists</select>";
    }

    static function getData($type, $index)
    {
        if(substr($type,0,7) == 'options')
        {
            $types = explode(':',$type);
            $options = $types[1];
            if(substr($type, 8,3) == 'obj')
            {
                $obj_array = explode(',',$options);
                $options = $obj_array[0];

                $conn = conn();
                $db   = new Database($conn);
                if(stringContains($type,'multiple'))
                {
                    $value = explode(',',$index);
                    $value = "('".implode("','",$value)."')";
                    $data = $db->all($options,[
                        $obj_array[1] => ['IN',$value]
                    ]);
                    $data = array_map(function($d) use ($obj_array){
                        return $d->{$obj_array[2]};
                    }, $data);
                    return implode(',',$data);
                }
                else
                {
                    $data = $db->single($options,[
                        $obj_array[1] => $index
                    ]);
                    if($data)
                    {
                        return $data->{$obj_array[2]};
                    }
                    else
                    {
                        return  '';
                    }
                }

            }
        }
        return $index;
    }
}