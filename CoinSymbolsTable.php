<?php
    require('TableBase.php');
    class CoinSymbolsTable extends TableBase {

        public $TableName = 'CoinSymbols';

        public $m_UID = "UID";
        public $m_Currency = "Currency";
        public $m_Symbol = "Symbol";
        public $m_Name = "Name";
        public $m_Scale = "Scale";

        private $_dataMap = array(); 

        public function GetCurrencySymbol($currency) {
            if (in_array($currency, array_keys($this->_dataMap))) {
                return $this->_dataMap[$currency][$this->m_Symbol];
            }
            
            echo "CoinSymbolsTable doesn't find currency " . $currency . " symbol. <br>";
            return null;
        }

        public function GetCurrencyScale($currency) {
            if (in_array($currency, array_keys($this->_dataMap))) {
                return $this->_dataMap[$currency][$this->m_Scale];
            }
            
            echo "CoinSymbolsTable doesn't find currency " . $currency . " scale. <br>";
            return null;
        }

        protected function OnLineParsed($idx, $lineData) {
            $uid = $lineData[$this->GetColumnNameIndex($this->m_UID)];
            $currency = $lineData[$this->GetColumnNameIndex($this->m_Currency)];
            $symbol = $lineData[$this->GetColumnNameIndex($this->m_Symbol)];
            $name = $lineData[$this->GetColumnNameIndex($this->m_Name)];
            $scale = $lineData[$this->GetColumnNameIndex($this->m_Scale)];
            //echo $uid . "+ " . $currency . "+ " . $symbol . "+ " . $name . "+ " . $scale . "<br>";

            if (!in_array($currency, $this->_dataMap)) {
                $value = array($this->m_Symbol => $symbol, $this->m_Name => $name, $this->m_Scale => $scale);
                $this->_dataMap[$currency] = $value;
                //print_r($value);
                //print_r($this->_dataMap[$currency]);
                //echo "<br>";
            }
            else {
                echo "CoinSymbolsTable parse currency redundant => " . $currency;
            }
        }

        protected function OnTableParsed() {
            // print_r($this->_dataMap);
            // echo "<br>";
        }
    }
?>