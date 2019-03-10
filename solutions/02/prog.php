<?php 
final class Number 
{
    private $numberValue;
    private $base;

    public function __contruct(string $number, int $base)
    {
        $this->numberValue = intval(base_convert($number), $base);
        $this->base = $base;
    }

    public function convert_base_to(int $base): Number 
    {
        $this->base = base;
    }

    public function add(Number $num): Number
    {
        if ($this->base == $num->base) {
            return new Number($this->numberValue + $num->numberValue, $this->base);
        } else {
            throw new Exception("Bases of added Numbers don't match");
        }
    }

    public function to_int(): int
    {
        return $this->numberValue;
    }
    
}

interface NumberFormatter 
{
    public function format_to_string(Number $num): string;
}

class RomanFormatter implements NumberFormatter
{
    public function format_to_string(Number $num): string 
    {
        $number = $num->to_int();
        $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
        $returnValue = '';
        while ($number > 0) {
            foreach ($map as $roman => $int) {
                if($number >= $int) {
                    $number -= $int;
                    $returnValue .= $roman;
                    break;
                }
            }
        }
        return $returnValue;
    }
}