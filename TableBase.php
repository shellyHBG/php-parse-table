<?php  
    class TableBase {
        
        public $TableName = 'TableBase';

        private $_content = array();
        private $_dataType = array();
        private $_columnName = array();

        function __construct() {
            $this->ParseAll();
        }

        public function GetLine($idx) {
            if (in_array($this->_content)) {
                return $this->_content[$idx];
            }

            echo "GetRow failed. data not found. table: " . $this->TableName . ", index: " . $idx . "<br>";
            return null;
        }

        public function GetValue($idx, $columnName) {
            $line = $this->GetLine($idx);
            if ($line === null) {
                return null;
            }

            $columnIndex = $this->GetColumnNameIndex($columnName);
            if ($columnIndex !== -1) {
                return $line[$columnIndex];
            }

            echo "GetValue failed. data not found. table: " . $this->TableName . ", index: " + $idx . ", columnName: " . $columnName . "<br>";
            return null;
        }

        public function GetColumnNameIndex($colName) {
            if (in_array($colName, $this->_columnName)) {
                return array_search($colName, $this->_columnName);
            }
            else {
                //echo $colName . " is not in column." . "<br>";
                return -1;
            }
        }

        protected function OnLineParsed($idx, $lineData) {

        }

        protected function OnTableParsed() {

        }

        private function ParseAll() {
            $tablePath = $this->TableName.'.txt';

            if(file_exists($tablePath)) {

                $tableFile = fopen($tablePath, 'r') or die("Unable to open file!");

                $this->_dataType = preg_split("/[\t]/", fgets($tableFile));
                //echo "data type length is " . count($this->_dataType) . "<br>";
                $this->_columnName = preg_split("/[\t]/", fgets($tableFile));
                //echo "column name length is " . count($this->_columnName) . "<br>";

                while(!feof($tableFile)) {
                    $line = fgets($tableFile);
                    $comp = preg_split("/[\t]/", $line);  // check tab
                    //echo "comp length is " . count($comp) . "<br>";
                    $index = $comp[0];

                    if (!in_array($index, array_keys($this->_content))) {
                        $this->_content[$index] = $comp;
                        $this->OnLineParsed($index, $comp);
                    }
                    
                    //echo $line . "<br>";
                }

                fclose($tableFile);
                $this->OnTableParsed();
                
            } else {
                echo $tablePath . "not exist. <br>";
            }
        }
    }

    // http://www.w3school.com.cn/php/php_file_open.asp
    /** fread
     * fread() 的第一个参数包含待读取文件的文件名，第二个参数规定待读取的最大字节数。
     * 如下 PHP 代码把 "CoinSymbols.txt" 文件读至结尾：
    **/
    // echo fread($myfile,filesize("CoinSymbols.txt"));
    
    /** fgets
     * fgets() 函数用于从文件读取单行。
     * 下例输出 "CoinSymbols.txt" 文件的首行：
     */
    // echo fgets($myfile);

    /** feof
     * feof() 函数检查是否已到达 "end-of-file" (EOF)。
     * feof() 对于遍历未知长度的数据很有用。
     * 下例逐行读取 "CoinSymbols.txt" 文件，直到 end-of-file：
     */
    // while(!feof($myfile)) {
    //     echo fgets($myfile) . "<br>";
    // }

    /** fgetc
     * fgetc() 函数用于从文件中读取单个字符。
     * 下例逐字符读取 "CoinSymbols.txt" 文件，直到 end-of-file：
     */
    // while(!feof($myfile)) {
    //     echo fgetc($myfile);
    // }

    /** fclose
     * fclose() 函数用于关闭打开的文件。
     * 注释：用完文件后把它们全部关闭是一个良好的编程习惯。您并不想打开的文件占用您的服务器资源。
     * fclose() 需要待关闭文件的名称（或者存有文件名的变量）：
     */
    // fclose($myfile);

?>