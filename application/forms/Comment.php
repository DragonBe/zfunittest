<?php
class Application_Form_Comment extends Zend_Form
{
    public function init()
    {
        $this->addElement('text', 'fullName', array (
            'label' => 'Full name',
            'required' => true,
            'filters' => array ('StripTags', 'StringTrim'),
            'validators' => array (
                array ('Alnum', false, array ('allowWhiteSpace' => true)),
                array ('StringLength', false, array ('min' => 4, 'max' => 50)),
            ),
        ));
        $this->addElement('text', 'emailAddress', array (
            'label' => 'E-mail address',
            'required' => true,
            'filters' => array ('StripTags', 'StringTrim', 'StringToLower'),
            'validators' => array (
                'EmailAddress',
                array ('StringLength', false, array ('min' => 4, 'max' => 50)),
            ),
        ));
        $this->addElement('text', 'website', array (
            'label' => 'Website URL',
            'required' => false,
            'filters' => array ('StripTags', 'StringTrim', 'StringToLower'),
            'validators' => array (
                array ('Regex', false, array ('/^http:\/\/[a-z0-9\_\-\.\/]+$/')),
            ),
        ));
        $this->addElement('textarea', 'comment', array (
            'label' => 'Your comment',
            'required' => false,
            'filters' => array ('StripTags'),
            'validators' => array (
                array ('StringLength', false, array ('max' => 50000)),
            ),
        ));
        $this->addElement('submit', 'send', array (
            'Label' => 'Send',
            'ignore' => true,
        ));
    }
}

