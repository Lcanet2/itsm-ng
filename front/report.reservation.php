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

include('../inc/includes.php');

Session::checkRight("reports", READ);

Html::header(Report::getTypeName(Session::getPluralNumber()), $_SERVER['PHP_SELF'], "tools", "report");

if (!isset($_GET["id"])) {
    $_GET["id"] = 0;
}

Report::title();

$form = [
   'action' => $_SERVER['PHP_SELF'],
   'buttons' => [
      [
         'value' => __s('Display report'),
         'class' => 'btn btn-secondary',
      ]
   ],
   'content' => [
      '' => [
         'visible' => true,
         'inputs' => [
            '' => [
               'type' => 'select',
               'name' => 'id',
               'values' => getOptionsForUsers('reservation'),
               'col_lg' => 12,
               'col_md' => 12,
            ]
         ]
      ]
   ]
];
renderTwigForm($form);

if ($_GET["id"] > 0) {
    Reservation::showForUser($_GET["id"]);
}
Html::footer();
