<?php

class Matrix
{
    private array $input;
    private array $output;

    public function __construct()
    {
        $this->input = [];
        $this->createEmptyOutput();
    }

    /**
     * Adds new row to the matrix.
     *
     * @param array $row
     *
     * @return $this
     */
    public function addRow(array $row): self
    {
        $this->input[] = $row;

        return $this;
    }

    /**
     * Performs rotation process.
     *
     * @param int $p the iteration level of the rotation. defaults to 0 means iterate from the top level
     *
     * @return $this
     */
    public function process(int $p = 0): self
    {
        $n = count($this->input) - 1;

        return $this->doProcess($n, $p);
    }

    /**
     * Displays the input and output arrays.
     *
     * @return void
     */
    public function display(): void
    {
        $this->doPrint($this->input, 'Input');
        $this->doPrint($this->output, 'Output');
    }

    /**
     * Performs recursive rotation internally.
     *
     * @param int $n
     * @param int $p
     *
     * @return $this
     */
    private function doProcess(int $n, int $p = 0): self
    {
        if ($p === $n || empty($this->input)) {
            return $this;
        }

        if ($n % 2 === 0) {
            $center = $n / 2;
            $this->output[$center][$center] = $this->input[$center][$center];
        }

        $i = $p;
        for ($j = $p + 1; $j <= $n - $p; $j++) {
            $this->output[$i][$j] = $this->input[$i][$j - 1];
            $this->output[$n - $i][$j - 1] = $this->input[$n - $i][$j];
        }

        $j = $n - $p;
        for ($i = $p + 1; $i <= $n - $p; $i++) {
            $this->output[$i][$j] = $this->input[$i - 1][$j];
            $this->output[$i - 1][$n - $j] = $this->input[$i][$n - $j];
        }

        return $this->doProcess($n, $p + 1);
    }

    /**
     * Create an empty output array.
     *
     * @return void
     */
    private function createEmptyOutput(): void
    {
        $this->output = [];
        $count = count($this->input);
        for ($k = 0; $k < $count; $k++) {
            // fill the output with `x`
            $this->output[] = array_fill(0, $count, 'x');
        }
    }

    /**
     * Displays the array correctly.
     *
     * @param array $array
     * @param string $label
     *
     * @return void
     */
    private function doPrint(array $array, string $label)
    {
        echo $label . ' = ' . PHP_EOL;
        $n = count($array);
        for ($i = 0; $i < $n; $i++) {
            for ($j = 0; $j < $n; $j++) {
                echo $array[$i][$j] . "\t\t";
            }
            echo PHP_EOL;
        }
        echo PHP_EOL;
    }
}

(new Matrix())
    /*->addRow([1, 2, 3, 4, 5])
    ->addRow([6, 7, 8, 9, 10])
    ->addRow([11, 12, 13, 14, 15])
    ->addRow([16, 17, 18, 19, 20])
    ->addRow([21, 22, 23, 24, 25])*/

    /*->addRow([1, 2, 3, 4])
    ->addRow([6, 7, 8, 9])
    ->addRow([11, 12, 13, 14])
    ->addRow([16, 17, 18, 19])*/
    ->process()
    ->display();
