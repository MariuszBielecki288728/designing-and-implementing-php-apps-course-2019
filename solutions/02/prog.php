<?php 
final class Number
{
    private $numberValue;
    private $base;

    public function __construct($number, int $base)
    {
        if (is_int($number)) {
            $this->numberValue = $number;
        } else {
            $this->numberValue = intval($number, $base);
        }
        $this->base = $base;
    }

    public function convert_base_to(int $base): Number
    {
        return new Number($this->numberValue, $base);
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

    public function get_representation(): string
    {
        return base_convert(strval($this->numberValue), 10, $this->base);
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

$formatter = new RomanFormatter();
$res = new Number(0, 10);

for ($i=1; $i < $argc; $i++) {
    $splitted_string = explode(":", $argv[$i]);
    $num = new Number($splitted_string[0], intval($splitted_string[1]));
    $res = $res->add($num->convert_base_to(10));
}

echo $res->get_representation()."\n";
echo $formatter->format_to_string($res)."\n";