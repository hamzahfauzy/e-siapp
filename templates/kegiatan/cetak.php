<h2 align="center">TARGET CAPAIAN PROGRAM PRIORITAS TAHUN 2021 S/D 2026</h2>
<table width="100%" border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th width="20px">#</th>
            <?php 
            foreach($fields as $field): 
                $label = $field;
                if(is_array($field))
                {
                    $label = $field['label'];
                }
                $label = _ucwords($label);
            ?>
            <th><?=$label?></th>
            <?php endforeach ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach($datas as $index => $data): ?>
        <tr>
            <td>
                <?=$index+1?>
            </td>
            <?php 
            foreach($fields as $key => $field): 
                $label = $field;
                if(is_array($field))
                {
                    $label = $field['label'];
                    $data_value = Form::getData($field['type'],$data->{$key});
                    if($field['type'] == 'number')
                    {
                        $data_value = is_numeric($data_value) ? number_format($data_value) : '';
                    }
                    $field = $key;
                }
                else
                {
                    if($field == 'total_target')
                    {
                        $data_value = preg_replace_callback( "/[0-9]+/", function ($matches) {
                            return number_format($matches[0]);
                        }, $data->{$field});
                    }
                    else
                        $data_value = $data->{$field};
                }
                $label = _ucwords($label);
            ?>
            <td><?=$data_value?></td>
            <?php endforeach ?>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
<script>window.print()</script>