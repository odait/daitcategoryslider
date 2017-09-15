<?php

/**
 *    This file is part of the module daitcategoryslider for OXID.
 *
 *    The module daitcategoryslider is free software: you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *
 *    The module daitcategoryslider is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU General Public License for more details.
 *
 * 
 *    @link        https://www.dalley-it.com
 *    @author      Oliver Dalley - Dalley IT, September 2017
 *    @version     V 1.0
 *
 *    @license     http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *    @copyright   (C) Oliver Dalley - Dalley IT 2017
 *
 */

class dait_categoryslider_event
{
    /*
     * Path to SQL
     */
    protected static $_sSqlPath = 'modules/dait/daitcategoryslider/install/install.sql';
    
    /**
     * Executes SQL file install
     *
     */
    public static function onActivate()
    {
        $oDb = oxDb::getDb();
        $sSqlFilePath = getShopBasePath() . self::$_sSqlPath;
        if ($sSqlFilePath) {
            $sSql = file_get_contents($sSqlFilePath);
            $oDb->execute($sSql); 
            oxRegistry::get("oxUtilsView")->addErrorToDisplay('DAIT_INSTALL_SUCCESSFULL');
        }
        return true;
    }    
    
}

