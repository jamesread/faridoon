<?php

namespace faridoon;

use libAllure\Form;
use libAllure\ElementInput;
use libAllure\DatabaseFactory;

class FormUsergroupCreate extends Form
{
    public function __construct()
    {
        parent::__construct('formAddPermissionToGroup', 'Grant permission for group');

        $this->addElement(new ElementInput('title', 'Title'));

        $this->addDefaultButtons('Create');
    }

    public function process()
    {
        $stmt = DatabaseFactory::getInstance()->prepare('INSERT INTO `groups` (title) VALUES (:title); ');
        $stmt->bindValue(':title', $this->getElementValue('title'));
        $stmt->execute();
    }
}
