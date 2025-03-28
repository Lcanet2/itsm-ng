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

/// Class WifiNetwork
/// since version 0.84
class WifiNetwork extends CommonDropdown
{
    public $dohistory          = true;

    public static $rightname          = 'internet';

    public $can_be_translated  = false;


    public static function getTypeName($nb = 0)
    {
        return _n('Wifi network', 'Wifi networks', $nb);
    }

    public static function getWifiCardVersion()
    {
        return [
           ''          => '',
           'a'         => 'a',
           'a/b'       => 'a/b',
           'a/b/g'     => 'a/b/g',
           'a/b/g/n'   => 'a/b/g/n',
           'a/b/g/n/y' => 'a/b/g/n/y',
           'ac'        => 'ac',
           'ax'        => 'ax',
        ];
    }


    public static function getWifiCardModes()
    {

        return [''          => Dropdown::EMPTY_VALUE,
                     'ad-hoc'    => __('Ad-hoc'),
                     'managed'   => __('Managed'),
                     'master'    => __('Master'),
                     'repeater'  => __('Repeater'),
                     'secondary' => __('Secondary'),
                     'monitor'   => Monitor::getTypeName(1),
                     'auto'      => __('Automatic')];
    }


    public static function getWifiNetworkModes()
    {

        return [''               => Dropdown::EMPTY_VALUE,
                     'infrastructure' => __('Infrastructure (with access point)'),
                     'ad-hoc'         => __('Ad-hoc (without access point)')];
    }


    public function defineTabs($options = [])
    {

        $ong  = [];
        $this->addDefaultFormTab($ong);
        $this->addStandardTab('NetworkPort', $ong, $options);

        return $ong;
    }


    public function getAdditionalFields()
    {

        return [
           __('ESSID') => [
              'name'  => 'essid',
              'type'  => 'text',
              'value' => $this->fields['essid'],
           ],
           __('Wifi network type') => [
              'name'  => 'mode',
              'type'  => 'select',
              'values' => self::getWifiNetworkModes(),
              'value' => $this->fields['mode'],
           ]
        ];
    }


    public function displaySpecificTypeField($ID, $field = [])
    {

        if ($field['type'] == 'wifi_mode') {
            Dropdown::showFromArray(
                $field['name'],
                self::getWifiNetworkModes(),
                ['value' => $this->fields[$field['name']]]
            );
        }
    }


    public function rawSearchOptions()
    {
        $tab = parent::rawSearchOptions();

        $tab[] = [
           'id'                 => '10',
           'table'              => $this->getTable(),
           'field'              => 'essid',
           'name'               => __('ESSID'),
           'datatype'           => 'string',
           'autocomplete'       => true,
        ];

        return $tab;
    }
}
