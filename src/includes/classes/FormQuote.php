<?php

namespace faridoon;

use libAllure\Form;
use libAllure\ElementInput;
use libAllure\ElementTextbox;
use libAllure\ElementCheckbox;
use libAllure\ElementSelect;

class FormQuote extends Form
{
    private $isEdit;

    public function __construct(array $quote = null)
    {
        parent::__construct('add', 'Add Quote');
        $this->setFullyQualifiedElementNames(false);

        $this->isEdit = is_array($quote);

        if ($this->isEdit) {
            $this->addElementHidden('id', $quote['id']);
            $content = $quote['content'];
            $this->setTitle('Editing...');
        } else {
            $content = 'Your quote here.';
        }

        $this->addElement(new ElementTextbox('content', 'Content', stripslashes($content), 'Note: Usernames are automatically highlighted. Timestamps are automatically stripped.'));

        global $cfg;
        if ($cfg->getBool('ENABLE_SYNTAX_HIGHLIGHTING')) {
            $this->addSyntaxHighlighting();
        } else {
            $this->addElementHidden('syntaxHighlighting', '');
        }

        //$el->setValue($quote['syntaxHighlighting']);
        $this->addButtons(Form::BTN_SUBMIT);
    }

    private function addSyntaxHighlighting()
    {
        $el = $this->addElement(new ElementSelect('syntaxHighlighting', 'Syntax highlighting for code?', false, 'Is this quote mostly code? If so, it will have pretty formatting applied and usernames will not be highlighted.'));
        $el->addOption('Nope', '');
        $el->addOption('C#', 'csharp');
        $el->addOption('Javascript', 'javascript');
        $el->addOption('PHP', 'php');
        $el->addOption('Java', 'java');
        $el->addOption('Python', 'python');

        $this->addElement($el);
    }

    public function process()
    {
        ($this->isEdit) ? $this->processEdit() : $this->processAdd();
    }

    public function processEdit()
    {
        global $db;
        global $cfg;

        if ($cfg->getBool('ENABLE_SYNTAX_HIGHLIGHTING')) {
            $syntaxHighlighting = $this->getElementValue('syntaxHighlighting');
        } else {
            $syntaxHighlighting = '';
        }

        $sql = 'UPDATE quotes SET content = :content, syntaxHighlighting = :syntaxHighlighting WHERE id = :id ';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':content', $this->getElementValue('content'));
        $stmt->bindValue(':syntaxHighlighting', $syntaxHighlighting);
        $stmt->bindValue(':id', $this->getElementValue('id'));
        $stmt->execute();
    }

    public function processAdd()
    {
        global $db;

        $sql = 'INSERT INTO quotes (content, created) VALUES (:content, now()) ';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':content', $this->getElementValue('content'));
        $stmt->execute();
    }
}
