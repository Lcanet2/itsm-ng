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

/// Class DeviceSimcard
class DeviceSimcard extends CommonDevice
{
    protected static $forward_entity_to = ['Item_DeviceSimcard', 'Infocom'];

    public static function getTypeName($nb = 0)
    {
        return _n('Simcard', 'Simcards', $nb);
    }

    public function getAdditionalFields()
    {

        return array_merge(
            parent::getAdditionalFields(),
            [
              _n('Type', 'Types', 1) => [
                 'name'  => 'devicesimcardtypes_id',
                 'type'  => 'select',
                 'values' => getOptionForItems('DeviceSimcardType'),
                 'value' => $this->fields['devicesimcardtypes_id'],
                 'actions' => getItemActionButtons(['info', 'add'], 'DeviceSimcardType')
              ],
              __('Voltage') => [
                 'name'  => 'voltage',
                 'type'  => 'number',
                 'after'  => 'mV',
                 'value' => $this->fields['voltage']
              ],
              __('Allow VOIP') => [
                    'name'  => 'allow_voip',
                    'type'  => 'checkbox',
                    'value' => $this->fields['allow_voip'],
              ],
            ]
        );
    }

    public function rawSearchOptions()
    {
        $tab = parent::rawSearchOptions();

        $tab[] = [
              'id'                 => '12',
              'table'              => $this->getTable(),
              'field'              => 'voltage',
              'name'               => __('Voltage'),
              'datatype'           => 'string',
              'autocomplete'       => true,
        ];

        $tab[] = [
              'id'                 => '13',
              'table'              => 'glpi_devicesimcardtypes',
              'field'              => 'name',
              'name'               => _n('Type', 'Types', 1),
              'datatype'           => 'dropdown'
        ];

        $tab[] = [
              'id'                 => '14',
              'table'              => $this->getTable(),
              'field'              => 'allow_voip',
              'name'               => __('Allow VOIP'),
              'datatype'           => 'bool'
        ];

        return $tab;
    }

    /**
     * Criteria used for import function
     *
     * @see CommonDevice::getImportCriteria()
     *
     * @since 9.2
     **/
    public function getImportCriteria()
    {

        return [
              'designation'             => 'equal',
              'manufacturers_id'        => 'equal',
              'devicesensortypes_id'    => 'equal',
        ];
    }


    public static function getIcon()
    {
        return "fas fa-sim-card";
    }
}
