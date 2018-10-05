<html>
    <head>
        <title>PHP Test</title>
    </head>
    <body>
        <?php

        require('CoinSymbolsTable.php');

        $coinSymbols = new CoinSymbolsTable;
        $symbol = $coinSymbols->GetCurrencySymbol('CAD');
        $scale = $coinSymbols->GetCurrencyScale('CAD');

        echo "CAD -> " . $symbol;
        echo "<br>";
        echo "CAD -> " . $scale;
        ?>
    </body>
</html>