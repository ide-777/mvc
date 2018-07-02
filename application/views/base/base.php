<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?=$pageTitle?></title>
    <meta name="description" content="<?=$pageDescription?>"/>
    <meta name="keywords" content="<?=$pageKeywords?>" />
    <link href="/src/css/style.css" type="text/css" rel="stylesheet" />

    <script type="text/javascript" src="/src/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="/src/js/base.js"></script>
    <script type="text/javascript" src="/src/js/main.js"></script>


</head>
<body>

<div class="container">
    <div class="container-menu">
        <ul>
        <?php
            foreach ($_PAGES AS $key => $value) { ?>
            <li><a class="menu-item-link <?=$value['id'] == $pageId ? 'active' : ''?>" href="<?=$key?>"><?=$value['title']?></a></li>
        <?php
            }
        ?>
        </ul>
    </div>

    <?php
        $this->getTemplateToZone('content');
    ?>
</div>
</body>
</html>