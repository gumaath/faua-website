<?php
namespace App;
class Funcoes {
    public static function sucessoTela() {
        echo <<<SCRIPT
        <script>window.location.replace('./src/views/success-volunteer-submit.php')</script>
    SCRIPT; 
    }
    public static function errorTela($path = './src/views') {
        echo <<<SCRIPT
        <script>window.location.replace('$path/error.php')</script>
    SCRIPT; 
    }
    
}
?>