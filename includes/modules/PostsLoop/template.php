<h1 id="tst" class="test">h1</h1>
<h1>h1-2, <?= $val ?></h1>
<?php 
    //global $post;
    //var_dump($post);

    $str_ids = '';
    foreach($args as $value)
        $str_ids .= "$value, ";

    echo '<br />';
    echo trim($str_ids, ', ');
    echo '<br />';

    $arr_ids = explode(',', trim($str_ids, ', '));

    var_dump($arr_ids);
?>