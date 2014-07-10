<?php
session_start();
/**
 * класс выводящий форму и HTML страницы
 */
require_once("./classes/Form.php");
/**
 * класс класс создающий пагинацию страниц и HTML пагинации
 */
require_once("./classes/Paginator.php");
/**
 * класс работающий с хранилищем сообщений
 */
require_once("./classes/Storage.php");
//error_reporting(E_ALL);