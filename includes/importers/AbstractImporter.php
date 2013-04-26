<?php

// we're using the PEAR Log package: pear install Log
require_once 'Log.php';
// we're using PEAR Console_Progressbar package: pear install channel://pear.php.net/Console_Progressbar-0.5.2beta
require_once 'Console/ProgressBar.php';

require_once __DIR__ . '/../constants.php';

interface CLI_Importer {

    static function CLI_commandName();

    static function CLI_commandDescription();

    static function CLI_longHelp();

    static function CLI_getCommand($parser);

    static function CLI_checkRequiredOpts($options);
}

interface Importer {

    static function import($options);
}

define('ERR_ILLEGAL_FILE_FORMAT', 'Unsupported file format. Please recheck');

abstract class AbstractImporter implements CLI_Importer, Importer {

    public static function CLI_getCommand($parser) {
        $command = $parser->addCommand(call_user_func(array(get_called_class(), 'CLI_commandName')),
                array(
            'description' => call_user_func(array(get_called_class(), 'CLI_commandDescription'), $parser)
        ));

        $command->add_help_option = false;

        $opt = $command->addOption('help',
                array(
            'short_name' => '-h',
            'long_name' => '--help',
            'action' => 'Help',
            'action_params' => array('class' => get_called_class()),
            'description' => 'show this help message and exit'
        ));

        $command->addOption('organism_id',
                array(
            'short_name' => '-o',
            'long_name' => '--organism_id',
            'description' => 'id of the organism this import is for'
        ));

        $command->addOption('import_prefix',
                array(
            'short_name' => '-p',
            'long_name' => '--import_prefix',
            'description' => 'this will be used as prefix for all uniquenames and displayed in the "dataset" dropdown'
        ));

        $command->addArgument('files', array(
            'multiple' => true,
            'description' => 'id of the organism this import is for'
        ));

        return $command;
    }

    public static function CLI_checkRequiredOpts($options) {
        self::dieOnMissingArg($options, 'organism_id');
        self::dieOnMissingArg($options, 'import_prefix');
    }

    static function preCommitMsg() {
        echo "\ncommiting changes to database. this may take a moment.\n";
    }

    public static $log;
    private static $bar;
    private static $announce_steps = 100;
    private static $barstr = '[%bar%] %fraction%(%percent%), elapsed: %elapsed% , remaining est.: %estimate%';

    protected static function setLineCount($count) {
        $width_exec = exec('tput cols 2>&1');
        $width = is_int($width_exec) && $width_exec > 0 ? $width_exec : 200;

        if (self::$bar == null) {
            self::$bar = new Console_ProgressBar(self::$barstr, '=>', ' ', $width, $count);
        }
        else {
            self::$bar->reset(self::$barstr, '=>', ' ', $width, $count);
        }
    }

    protected static function updateProgress($current_count) {
        if ($current_count % self::$announce_steps != 0)
            return;
        self::$bar->update($current_count);
    }

    protected static function dieOnMissingArg($options, $argname) {
        if (!isset($options[$argname]))
            throw new Exception(sprintf('option --%s has to be set', $argname));
    }

}

require_once 'Console/CommandLine/Action.php';

class Console_CommandLine_Action_ExtendedHelp extends Console_CommandLine_Action {

    public function execute($value = false, $params = array()) {
        $helpstr = $this->parser->renderer->usage();
        if (isset($params['class']) && class_exists($params['class']))
            $helpstr.=call_user_func(array($params['class'], 'CLI_longHelp')) . "\n";
        $this->parser->outputter->stdout($helpstr);
        exit(0);
    }

}

//overwrite CommandLine Help function... ouch!
Console_CommandLine::$actions['Help'] = array('Console_CommandLine_Action_ExtendedHelp', false);

//set importer Log instance
AbstractImporter::$log = Log::factory('console', '', 'Importer');
?>
