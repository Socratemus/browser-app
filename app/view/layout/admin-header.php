<?php echo $this->getDoctype();?>
<html>
    
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="Romanian" />
        <meta http-equiv="Content-Language" content="ro" />
        <meta name="description" content="<?php if ($this->getMeta()) echo $this->getMeta() ?>"/>
        <title>Administration Area</title>
        <?php
            if (isset($this->javascriptFiles)) { //echo 'am js files!';
                foreach ($this->javascriptFiles as $js)
                    echo "<script type='text/javascript' src='" . $js . "'></script>\n";
            }
            if (isset($this->cssFiles)) {
                foreach ($this->cssFiles as $css)
                    echo "<link rel='stylesheet' type='text/css' href='" . $css . "' />\n";
            }
        ?>
        
    </head>
    
    <body>
        
        <header class="container-fluid">
            <!--<pre><?php //var_dump($_SESSION)?></pre>-->
            <?php if($success = \vendor\Session::getFlashMessage('success_message')): ?>
                <pre><?php echo $success;?></pre>
            <?php endif;?>
            <?php if($validation = \vendor\Session::getFlashMessage('validation')): ?>
                <pre><?php echo $validation;?></pre>
            <?php endif;?>
            <?php if($exception = \vendor\Session::getFlashMessage('exception')): ?>
                <pre><?php echo $exception;?></pre>
            <?php endif;?>
            
        </header>
        
        <section class="container-fluid">