<?php

namespace Danzabar\CLI\Tasks\Utility;

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
     * Set up arguments and options for the main action
     *
     * @return void
     */
    public function setupMain()
    {
        $this->argument->addExpected('task', InputArgument::OPTIONAL);
    }

    /**
     * The main action
     *
     * @Action
     * @return void
     */
    public function main()
    {
        // App Details
        $this->printApplicationDetails();

        // Instructions
        $this->printApplicationInstructions();

        if (!$this->argument->task) {

            $this->listCommands($this->library->getAll());
        } else {

            $this->listCommands(
                $this->library->get($this->argument->task)
            );
        }
    }

    /**
     * Prints the app name and version
     *
     * @return void
     */
    public function printApplicationDetails()
    {
        $this->output->writeln($this->console->getName());

        if (!is_null($this->console->getVersion())) {
            $this->output->writeln('version '.$this->console->getVersion());
        }

        // New line padding
        $this->output->writeln('');
    }

    /**
     * Prints the application instructions
     *
     * @return void
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
     */
    public function listCommands(Array $commands)
    {
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
