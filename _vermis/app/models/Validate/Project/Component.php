<?php

/**
 * =============================================================================
 * @file        Validate/Project/Component.php
 * @author      Lukasz Cepowski <lukasz@cepowski.com>
 * @package     Vermis
 * @version     $Id: Component.php 1353 2012-12-26 20:46:41Z cepa $
 * 
 * @copyright   Vermis :: The Issue Tracking System
 *              Copyright (C) 2010-2012 HellWorx Software
 *              All rights reserved.
 *              www.hellworx.com
 * =============================================================================
 */

/**
 * @class Validate_Project_Component
 * @brief Validator for component name and slug.
 */
class Validate_Project_Component extends Zend_Validate_Abstract
{

    const COMPONENT_EXISTS = 'componentExists';

    protected $_messageTemplates = array(
        self::COMPONENT_EXISTS => 'Component already exists'
    );
    
    protected $_projectId = null;
    
    public function __construct($projectId)
    {
        $this->_projectId = $projectId;
    }

    public function isValid($value)
    {
        $this->_setValue($value);

        if (Doctrine::getTable('Project_Component')->componentExists(
                $this->_projectId,
                FreeCode_String::normalize($value)
            )) {
            $this->_error(null);
            return false;
        }
            
        return true;
    }

}
