<?php

namespace faridoon;

use libAllure\Form;
use libAllure\ElementInput;
use libAllure\ElementSelect;
use libAllure\DatabaseFactory;
use libAllure\Shortcuts;
use libAllure\Sanitizer;

class FormAddUserToGroup extends Form
{
    public function __construct()
    {
        parent::__construct('formChangeUsergroup', 'Change usergroup');

        $uid = Shortcuts::san()->filterUint('uid');

        $this->addElementReadOnly('User', $uid, 'uid');
        $this->addElementUsergroup();

        $this->addDefaultButtons('Change group');
    }

    private function addElementUsergroup()
    {
        $stmt = DatabaseFactory::getInstance()->prepare('SELECT g.id, g.title FROM `groups` g');
        $stmt->execute();

        $el = new ElementSelect('gid', 'Group');

        foreach ($stmt->fetchAll() as $group) {
            $el->addOption($group['title'], $group['id']);
        }

        $this->addElement($el);
    }

    public function process()
    {
        $stmt = DatabaseFactory::getInstance()->prepare('UPDATE users u SET u.`group` = :gid WHERE u.id = :uid');
        $stmt->bindValue(':uid', $this->getElementValue('uid'));
        $stmt->bindValue(':gid', $this->getElementValue('gid'));
        $stmt->execute();
    }
}
