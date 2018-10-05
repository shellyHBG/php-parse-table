# php-parse-table
Including the following functionality
*   Load table (parsing line)
*   Base class
*   Extented function

### how to use
Parse CoinSymbol.txt as example:
1.  Customize CoinSymbolTable class
2.  Add the customized function to fetch the column value

### note
Only support for table with below format:  
row 1 => [type] [type]  ...  
row 2 => [key1] [key2]  ...  
row 3 => [data1-1]  [data1-2] ...  
...  
