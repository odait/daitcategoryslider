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
 * Purpose:     Extension of oxviewconfig.php.
 *              Handles Category Sliders
 *              Part of Module daitcategoryslider
 */
class dait_catslideroxviewconfig extends dait_catslideroxviewconfig_parent 
{
    
    
    /**
     * Returns true if slides exist for active category
     * 
     * @param String $sCategoryId 
     *
     * @return Boolean
     */
    public function hasCategorySlides($sCategoryId) 
    {
        $bReturn = false;
        if ($sCategoryId && $sCategoryId != "-1") {  
            $oSlideList = oxNew('oxActionList');
            $bReturn = $oSlideList->areAnyActiveSlides($sCategoryId);
        }      
        return $bReturn;
    }
    
    /**
     * Returns List of slides for active category
     * 
     * @param String $sCategoryId 
     *
     * @return oxactionlist $oSlideList
     */
    public function getSlidesOfCategory($sCategoryId)
    {
        $oSlideList = null;

        if ($sCategoryId && $sCategoryId != "-1") {        
            $oSlideList = oxNew('oxActionList');
            $oSlideList->loadSlides($sCategoryId);
        }
        return $oSlideList;
    }
    
    
    
    
}