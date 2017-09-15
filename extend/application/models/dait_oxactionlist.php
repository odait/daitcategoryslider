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

/**
 * Purpose:     Extension of oxactionlist.php.
 *              Extends the model to handle dait_category_slider
 * 
 */
class dait_oxactionlist extends dait_oxactionlist_parent
{
    /**
     * return true if there are any active slides of category
     *
     * @param String $sCatId
     * 
     * @return boolean
     */
    public function areAnyActiveSlides($sCatId)
    {
        $oDb = oxDb::getDb();
        $sCatId = $oDb->quote($sCatId);
        $sQ = "select 1 from " . getViewName('oxactions') . " left join daitaction2category on " .
              getViewName('oxactions') . ".oxid=daitaction2category.oxactionid " .  
              "where oxtype=9 and oxactive=1 and daitaction2category.oxcatid=$sCatId limit 1";
        
        return (bool) $oDb->getOne($sQ);
    }


    /**
     * load active shop banner list
     */
    public function loadSlides($sCatId)
    {
        $oDb = oxDb::getDb();
        $sCatId = $oDb->quote($sCatId);
        $oBaseObject = $this->getBaseObject();
        $oViewName = $oBaseObject->getViewName();
        $sQ = "select {$oViewName}.* from {$oViewName} left join daitaction2category on "
              . "{$oViewName}.oxid=daitaction2category.oxactionid "
              . "where oxtype=9 and " . $oBaseObject->getSqlActiveSnippet()
              . " and daitaction2category.oxcatid=$sCatId "
              . $this->_getUserGroupFilter() . " order by oxsort";
        $this->selectString($sQ);
    }

}