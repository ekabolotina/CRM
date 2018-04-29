<?php

try {
    echo $twig->render( 'err_404.html.twig');
} catch (Exception $exception) {
    echo $exception->getMessage();
}
