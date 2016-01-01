<?php namespace Danzabar\CLI\Tasks\Utility;

use Danzabar\CLI\Tasks\Task;

/**
 * The Help task
 *
 * @package CLI
 * @subpackage Tasks
 * @author Dan Cox
 */
class Help extends Task
{
    /**
     * Task name
     *
     * @var string
     */
    protected $name = 'help';

    /**
     * The description
     *
     * @var string
     */
    protected $description = 'Returns a list of commands and helpful guide to running them.';

    /**
     * The main action
     *
     * @Action
     * @return void
     * @author Dan Cox
     */
    public function main()
    {
        // App Details
        $this->printApplicationDetails();

        // Instructions
        $this->printApplicationInstructions();

        // Command List
        $this->listCommands();
    }

    /**
     * Prints the app name and version
     *
     * @return void
     * @author Dan Cox
     */
    public function printApplicationDetails()
    {
        $this->output->writeln($this->console->getName());
        $this->output->writeln('version '.$this->console->getVersion());

        // New line padding
        $this->output->writeln('');
    }

    /**
     * Prints the application instructions
     *
     * @return void
     * @author Dan Cox
     */
    public function printApplicationInstructions()
    {
        $this->output->writeln('php [file] [command] [arguments] [options]');

        // Padding
        $this->output->writeln('');
    }

    /**
     * Lists out command names and descriptions
     *
     * @return void
     * @author Dan Cox
     */
    public function listCommands()
    {
        $commands = $this->library->getAll();

        foreach ($commands as $name => $details) {
            $this->output->writeln(ucwords($name));
            $this->output->hr(strlen($details['description']), '-');
            $this->output->writeln($details['description']);
            $this->output->hr(strlen($details['description']), '-');

            foreach ($details['actions'] as $action) {
                $this->output->writeln(
                    sprintf(
                        "%s - php [file] %s%s [params]",
                        $action,
                        $name,
                        ($action != 'main' ? ":$action" : '')
                    )
                );
            }

            // Just for padding
            $this->output->writeln('');
        }
    }
} // END class Help extends Task
