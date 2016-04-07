<?php namespace Era\Core\Companent;
class CompanentBuilderError {
    protected static $errors = array(
                'version' => array(
                    'novalid' => 'Please enter your version as x.x.x.',
                    'setnovalid' => 'Please enter your version as x.x.x.',
                    'getnovalid' => 'Please enter your version of plugin.'
                ),
                'compare' => array(
                    'available' => 'There is a new version.',
                    'updated' => 'This plugin is updated.'
                ),
                'AI' => array(
                    'I' => 'You must use ICompanentBuiler of interface on your class.',
                    'A' => 'You must use ACompanentBuiler of abstract on your class.',
                    'ICnovalid' => 'This companent must have ICompanent interface.'
                )
            );

    public static function getError($main, $sub) {
        self::jsonOutput(array('response' => 0, 'error_message' => self::$errors[$main][$sub]));
    }

    public static function getSuccess() {
        self::jsonOutput(array('response' => 1));
    }

    public static function jsonOutput(Array $object = null){
        echo json_encode($object);
    }
}