<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?=$pageTitle?></title>
    <meta name="description" content="<?=$pageDescription?>"/>
    <meta name="keywords" content="<?=$pageKeywords?>" />

    <script type="text/javascript" src="/src/js/jquery-3.3.1.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <link href="/src/css/style.css" type="text/css" rel="stylesheet" />

    <script type="text/javascript" src="/src/js/base.js"></script>
    <script type="text/javascript" src="/src/js/main.js"></script>


</head>
<body>
<div class="container">
    <div class="row">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Ide-777</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <ul class="collapse navbar-collapse" id="navbarNav">


                <ul class="navbar-nav mr-auto">
                    <?php
                    ($m = function($menu) use (&$m){
                        foreach ($menu AS $key => $value) {
                            $parent = $value['parent'];

                            echo '<li class="nav-item '.(!empty($parent) ? 'dropdown' : '').'">';

                            echo '<a  href="'.(!empty($parent) ? '#' : $key).'" id ="'.md5($key).'" class = "nav-link '.(!empty($parent) ? 'dropdown-toggle' : '').'"  '.(!empty($parent) ? 'data-toggle="dropdown"' : '').'>
                                          '.$value['title'].'
                                          </a>';


                            if (!empty($parent)) {
                                echo '<ul class="dropdown-menu" id = "'.md5($key).'" >';
                                    $m($parent);
                                echo '</ul>';

                            }


                            echo '<li>';
                        }

                    })($_PAGES);
                    ?>
                </ul>
    </div>
    </nav>

    <main role="main"  class="container">
        <div class="row">
            <?php
            $this->getTemplateToZone('content');
            ?>
        </div>
    </main>
</div>
</div>
</body>
</html>