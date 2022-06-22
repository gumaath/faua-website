<?php
namespace App;
include ($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');

use App\Connect;

class Auth {

    public static function verificaLogin($email, $senha) {
        $db = new Connect();
        $dbcon = $db->ConnectDB();

    $stmt = $dbcon->query("SELECT * from tb_voluntarios WHERE email_voluntario = '$email' AND senha_acesso = '$senha' and ativo_voluntario = 1");
    $user = $stmt->fetch();
    if ($user)
        return true;
    else
        return false;
    }  

    public static function verificaLoginAdmin($email, $senha) {
        $db = new Connect();
        $dbcon = $db->ConnectDB();

        $stmt = $dbcon->query("SELECT * from tb_admins WHERE email_usuario = '$email' AND senha_acesso = '$senha'");
        $user = $stmt->fetch();
        if ($user)
            return true;
        else
            return false;
    }  

    public static function createSession($email) {
    session_start();
    session_regenerate_id(true);
    $session_id = session_id();
    $db = new Connect();
    $dbcon = $db->ConnectDB();
    print_r("INSERT INTO session(email, session, session_time) VALUES('{$email}', '{$session_id}', NOW())");
    $session = $dbcon->query("INSERT INTO session(email, session, session_time) VALUES('{$email}', '{$session_id}', NOW())");

    return $session;   
    }

    public static function verificaSessionLogin() {
        $db = new Connect();
        $dbcon = $db->ConnectDB();
        $session = $dbcon->query("SELECT * from session WHERE email = '{$_COOKIE['login']}' AND session = '". $_COOKIE['PHPSESSID'] . "' ORDER BY session_time DESC")->fetch();
        if ($session) {
            $dbcon->query("DELETE FROM session WHERE email = '{$_COOKIE['login']}' AND session <>'" . $_COOKIE['PHPSESSID'] . "';");
            $dbcon->query("UPDATE session SET session_time = NOW() WHERE email = '{$_COOKIE['login']}' AND session = '". $_COOKIE['PHPSESSID'] . "' ORDER BY session_time DESC");
        }
    
        return $session;   
        }
}
?>