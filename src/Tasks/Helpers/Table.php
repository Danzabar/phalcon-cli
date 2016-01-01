<?php namespace Danzabar\CLI\Tasks\Helpers;

use Danzabar\CLI\Tasks\Helpers\Helper;

/**
 * The table helper class
 *
 * @package CLI
 * @subpackage Tasks\Helpers
 * @author Dan Cox
 */
class Table extends Helper
{
    /**
     * The character used to fill a verticle bar
     *
     * @var string
     */
    protected $table_barFiller = '-';

    /**
     * The character that encloses the header.
     *
     * @var string
     */
    protected $table_headerPart = '|';

    /**
     * The left side connector
     *
     * @var string
     */
    protected $table_connectorLeft = '+';

    /**
     * The right side connector
     *
     * @var string
     */
    protected $table_connectorRight = '+';

    /**
     * The header connector
     *
     * @var string
     */
    protected $table_connectorHeader = '+';

    /**
     * Draws a table from the array passed to it.
     *
     * @return void
     * @author Dan Cox
     */
    public function draw(array $data)
    {
        $lengths = $this->calcLength($data);

        $this->writeHeaders($lengths);

        $this->writeData($data, $lengths);

        $this->writeFooter($lengths);
    }

    /**
     * Writes the table
     *
     * @return void
     * @author Dan Cox
     */
    public function writeData(array $data, array $lengths)
    {
        foreach ($data as $row) {
            $rowOutput = $this->table_headerPart;

            foreach ($row as $key => $value) {
                $rowOutput .= ' '.str_pad($value, $lengths[$key], ' ', STR_PAD_RIGHT).' '.$this->table_headerPart;
            }

            $this->output->writeln($rowOutput);
        }
    }

    /**
     * Writes a decorative footer
     *
     * @return void
     * @author Dan Cox
     */
    public function writeFooter(array $headers)
    {
        $bar = $this->table_connectorLeft;

        foreach ($headers as $name => $length) {
            $bar .= str_pad('', $length + 2, $this->table_barFiller).''.$this->table_connectorRight;
        }

        $this->output->writeln($bar);
    }

    /**
     * Outputs the headers with padding previously calculated
     *
     * @return void
     * @author Dan Cox
     */
    public function writeHeaders(array $headers)
    {
        $bar = $this->table_connectorHeader;
        $header = $this->table_headerPart;

        foreach ($headers as $name => $length) {
            $bar .= str_pad('', $length + 2, $this->table_barFiller).$this->table_connectorHeader;

            $header .= ' '.str_pad($name, $length, ' ', STR_PAD_RIGHT).' '.$this->table_headerPart;
        }

        $this->output->writeln($bar);
        $this->output->writeln($header);
        $this->output->writeln($bar);
    }

    /**
     * Calculate the length of the table
     *
     * @return Array
     * @author Dan Cox
     */
    public function calcLength(array $data)
    {
        $lengths = array();

        foreach ($data as $table) {
            foreach ($table as $key => $value) {
                $len = strlen($value);

                if (!isset($lengths[$key]) || $len > $lengths[$key]) {
                    $lengths[$key] = $len;
                }

                if (isset($lengths[$key]) && strlen($key) > $lengths[$key]) {
                    $lengths[$key] = strlen($key);
                }
            }
        }

        return $lengths;
    }
} // END class Table extends Helper
