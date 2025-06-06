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

if (!defined('GLPI_ROOT')) {
    die("Sorry. You can't access this file directly");
}

/**
 * Relation between item and devices
 **/
class Item_DeviceProcessor extends Item_Devices
{
    public static $itemtype_2 = 'DeviceProcessor';
    public static $items_id_2 = 'deviceprocessors_id';

    protected static $notable = false;


    public static function getSpecificities($specif = '')
    {

        return [
           'frequency' => [
              'long name'  => sprintf(
                  __('%1$s (%2$s)'),
                  __('Frequency'),
                  __('MHz')
              ),
              'short name' => __('Frequency'),
              'size'       => 10,
              'id'         => 20,
              'autocomplete' => true,
              'formContent' => [
                 'type' => 'number',
                 'min' => 0,
              ]
           ],
           'serial'    => parent::getSpecificities('serial'),
           'otherserial' => parent::getSpecificities('otherserial'),
           'locations_id' => parent::getSpecificities('locations_id'),
           'states_id' => parent::getSpecificities('states_id'),
           'nbcores'   => [
              'long name'  => __('Number of cores'),
              'short name' => __('Cores'),
              'size'       => 2,
              'id'         => 21,
              'autocomplete' => true,
              'formContent' => [
                 'type' => 'number',
                 'min' => 0,
              ]
           ],
           'nbthreads' => [
              'long name' => __('Number of threads'),
              'short name' => __('Threads'),
              'size'       => 2,
              'id'         => 22,
              'autocomplete' => true,
              'formContent' => [
                 'type' => 'number',
                 'min' => 0,
              ]
           ],
           'busID'     => parent::getSpecificities('busID')
        ];
    }
}
