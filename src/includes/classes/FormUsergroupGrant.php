<?php

namespace faridoon;

use libAllure\Form;
use libAllure\Session;
use libAllure\Shortcuts;
use libAllure\ElementSelect;
use libAllure\DatabaseFactory;

class FormUsergroupGrant extends Form
{
    public function __construct()
    {
        parent::__construct('formAddPermissionToGroup', 'Grant permission for group');

        $sql = 'SELECT g.id FROM `groups` g WHERE g.id = :group';
        $stmt = DatabaseFactory::getInstance()->prepare($sql);
        $stmt->bindValue(':group', Shortcuts::san()->filterUint('gid'));
        $stmt->execute();

//        var_dump(Shortcuts::san()->filterUint('gid')); exit;
        $group = $stmt->fetchRowNotNull();

        $this->addElementReadOnly('Usergroup', $group['id'], 'gid');

        $this->addElementPermission();
        $this->addDefaultButtons('Grant');
    }

    public function addElementPermission()
    {
        global $db;

        $el = new ElementSelect('permission', 'Permission');

        $sql = 'SELECT p.key, p.id FROM permissions p ORDER BY p.key ASC';
        $stmt = $db->prepare($sql);
        $stmt->execute();

        foreach ($stmt->fetchAll() as $perm) {
            $el->addOption($perm['key'], $perm['id']);
        }

        $this->addElement($el);
    }

    public function process()
    {
        global $db;
        $stmt = $db->prepare('INSERT INTO privileges_g (permission, `group`) values (:permission, :group) ');
        $stmt->bindValue(':permission', $this->getElementValue('permission'));
        $stmt->bindValue(':group', $this->getElementValue('gid'));
        $stmt->execute();
    }
}
