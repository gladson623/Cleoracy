<?php 

    class Math {

        protected Calculator $Calculator;
        protected Quizzner $Quizzner;


        public function __construct() {
            
            $this->Calculator = new Calculator();
            $this->Quizzner = new Quizzner();

        }


        public function calculator() : Calculator {

            return $this->Calculator;

        }

        public function Quizzner() : Quizzner {
            return $this->Quizzner;
        }


    }

    class Quizzner {

        public function __construct() {
            


        }


        public function generate(int $qntd = 1, int $difficult = 1) {

            

        }

    }

    class Calculator {
        
        private array|null $Numbers, $Memory, $Variables;
        private string|null $Sentence;
        private mixed $Result;
        

        public function __construct() {
            


        }


        public function reset(int $target = 0, bool $save = false) : void {

            if($target !== 0) {

                $this->Memory == null;

                return;
            }

            if($save) $this->Memory = $this->Numbers;

            $this->Result = null;
            $this->Sentence = null;
            $this->Numbers = null;

        }

        public function bindVariable(mixed ...$var) : ?Calculator {

            if (!isset($this->Variables) || !is_array($this->Variables)) {
                $this->Variables = array();
            }
        
            $numArgs = count($var);
        
            if ($numArgs % 2 !== 0) throw new Exception("Número de argumentos inválido. Deve haver uma chamada seguida por um valor correspondente.");
        
            for ($i = 0; $i < $numArgs; $i += 2) {
                $call = $var[$i];
                $value = $var[$i + 1];
                $this->Variables[$call] = $value;
            }
        
            return $this;
        }

        public function bindNumber(int|float|string $Value) : ?Calculator {

            if(!isset($this->Variables) || !is_array($this->Variables)) $this->Variables = array();


            array_push($this->Variables, $Value);

            return $this;
        }

        public function getResult(int $decimal = 2) : mixed {

            if(!isset($this->Sentence) || !isset($this->Result)) return null;

            return is_string($this->Result) ? $this->Result : round($this->Result, $decimal, PHP_ROUND_HALF_EVEN);

        }

        public function Create_Sentence(string $Sentence) : Calculator|bool {


            $this->Sentence = $Sentence;

            return $this;

        }



        public function Calculate() : Calculator|bool {


            if(!isset($this->Sentence)) return false;

            if(isset($this->Variables)) array_walk($this->Variables, function ($k, $v) {

                $this->Sentence = str_replace($v, $k, $this->Sentence);

            });

            $this->processOperators();

            try {
                $this->Result = floatval(eval("return $this->Sentence;"));
            } catch (\Throwable $th) {
                $this->Result = "Não foi possível efetuar o calculo! Variáveis indefinidas ou inválidas";
            }

    

            return $this;

        }



        //PRIVATE METHODS:

        private function factorial(int $number): int|string {
            if ($number < 0) {
                throw new Exception("Fatorial não definido para números negativos.");
            }
        
            if ($number === 0 || $number === 1) {
                return 1;
            }
        
            $result = 1;
            for ($i = 2; $i <= $number; $i++) {
                $result = bcmul($result, (string) $i); // Usar bcmul para multiplicação de precisão arbitrária
            }
            
        
            return $result;
        }
        
        
    
        private function replaceFactorial(array $matches) : string {
            $number = intval($matches[1]);
            $factorial = $this->factorial($number);
            return strval($factorial);
        }
    
        private function processFactorial() : void{
            $this->Sentence = preg_replace_callback("/(\d+)\s*!/", array($this, "replaceFactorial"), $this->Sentence);
        }

        private function processOperators() : void {
            $this->processFactorial();
        }

    }


?>