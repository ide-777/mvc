<div class="tree">
<?php

    function render($vars)
    {
        echo '<ul>';
        foreach ($vars AS $v) {
            echo '<li>' . $v['name'] . '</li>';
            if ($v['isFile'] == 0) {
                render($v['child']);
            }
        }
        echo '</ul>';
    }

    render($_VARS['directory']);
?>
</div>
