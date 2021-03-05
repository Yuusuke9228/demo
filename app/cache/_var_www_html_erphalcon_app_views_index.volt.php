<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>
          <?php if (isset($title)) { ?>
            <?= '隼.' . $this->escaper->escapeHtml($title) ?>
          <?php } else { ?>
            隼.販売管理
          <?php } ?>
        </title>
        <link rel="stylesheet" href="<?= $this->url->get('css/bootstrap/bootstrap.min.css') ?>"><!-- https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> -->
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css"> -->
        <link rel="stylesheet" href="<?= $this->url->get('css/jquery/jquery-ui.min.css') ?>"><!-- https://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css" > -->
        <link rel="stylesheet" href="<?= $this->url->get('css/font-awesome-4.7.0/css/font-awesome.min.css') ?>"><!-- <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet"> -->
        <link rel="stylesheet" href="<?= $this->url->get('css/jquery/flexigrid.pack.css') ?>">
        <?= $this->tag->stylesheetLink('css/erp.css') ?>
        <link rel="shortcut icon" href="<?= $this->url->get('img/favicon.ico') ?>" type="image/x-icon"/>
        <?php if (isset($exp)) { ?>
			<meta http-equiv="Refresh" content="0;URL='<?= $exp ?>'">
        <?php } ?>
    </head>
    <body style="background-color:#f8f0e0"><!-- background="<?= $this->url->get('img/wood.jpg') ?>"> -->
        <script src="<?= $this->url->get('js/jquery/jquery-2.1.4.min.js') ?>"></script><!-- https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
        <!-- <div class="container"> -->
            <?= $this->getContent() ?>
        <!-- </div> -->
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="<?= $this->url->get('js/jquery/jquery-ui.min.js') ?>"></script><!-- https://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script> -->
        <script src="<?= $this->url->get('js/jquery/jquery.ui.datepicker-ja.min.js') ?>"></script><!-- https://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script> -->
        <!-- Latest compiled and minified JavaScript -->
        <script src="<?= $this->url->get('js/bootstrap/bootstrap.min.js') ?>"></script><!-- https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> -->
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/js/bootstrap-select.min.js"></script> -->
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/js/i18n/defaults-*.min.js"></script>-->
        <script type="text/javascript" src="<?= $this->url->get('js/enter2tab.js') ?>?var=20190405"></script>
        <script type="text/javascript" src="<?= $this->url->get('js/jquery/jquery.floatThead.min.js') ?>"></script>
        <script type="text/javascript" src="<?= $this->url->get('js/jquery/flexigrid.pack.js') ?>"></script>

    </body>
</html>
