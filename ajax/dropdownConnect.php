<?php

/**
 * ---------------------------------------------------------------------
 * GLPI - Gestionnaire Libre de Parc Informatique
 * Copyright (C) 2015-2022 Teclib' and contributors.
 *
 * http://glpi-project.org
 *
 * based on GLPI - Gestionnaire Libre de Parc Informatique
 * Copyright (C) 2003-2014 by the INDEPNET Development Team.
 *
 * ---------------------------------------------------------------------
 *
 * LICENSE
 *
 * This file is part of GLPI.
 *
 * GLPI is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * GLPI is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with GLPI. If not, see <http://www.gnu.org/licenses/>.
 * ---------------------------------------------------------------------
 */

if (strpos($_SERVER['PHP_SELF'], "dropdownConnect.php")) {
    include('../inc/includes.php');
    header("Content-Type: text/html; charset=UTF-8");
    Html::header_nocache();
} elseif (!defined('GLPI_ROOT')) {
    die("Sorry. You can't access this file directly");
}

if (!isset($_POST['fromtype']) || !($fromitem = getItemForItemtype($_POST['fromtype']))) {
    exit();
}

$fromitem->checkGlobal(UPDATE);

$used = [];
if (isset($_POST["used"])) {
    $used = $_POST["used"];
}
$options = getItemByEntity(
    $_POST['itemtype'],
    $_POST["entity_restrict"]
);
if (isset($used[$_POST['itemtype']])) {
    $options = array_diff_key($options, array_combine($used[$_POST['itemtype']], $used[$_POST['itemtype']]));
}
echo json_encode($options);
// Computer_Item::dropdownConnect($_POST["itemtype"], $_POST['fromtype'], $_POST['myname'],
//                                $_POST["entity_restrict"], $_POST["onlyglobal"], $used);
