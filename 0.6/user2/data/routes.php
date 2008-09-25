<?php
$aRoutes = array(
    array('login', array(
        'moduleName' => 'user2',
        'controller' => 'login2',
        'action' => 'login'
    )),
    array('register', array(
        'moduleName' => 'user2',
        'controller' => 'login2',
        'action' => 'register'
    )),
    array('logout', array(
        'moduleName' => 'user2',
        'controller' => 'login2',
        'action' => 'logout'
    )),
    array('password/reset', array(
        'moduleName' => 'user2',
        'controller' => 'passwordrecovery'
    )),
    array('password/reset/:userId/:k', array(
        'moduleName' => 'user2',
        'controller' => 'passwordrecovery',
        'action' => 'reset'
    )),
);
?>