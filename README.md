# DiakritikAPI - nástroj na rekonštrukciu diakritiky
**PHP trieda, pomocou ktorej môžete dopĺňať alebo odstraňovať diakritiku v textoch.** Využíva pri tom nástroj [Diakritik](https://diakritik.juls.savba.sk/) z dielne [Jazykovedného ústavu Ľudovíta Štúra Slovenskej akadémie vied](https://www.juls.savba.sk/).

![GitHub all releases](https://img.shields.io/github/downloads/martinille/DiakritikAPI/total?style=plastic)
![GitHub last commit](https://img.shields.io/github/last-commit/martinille/DiakritikAPI?style=plastic)
![PHP version](https://img.shields.io/badge/php-7.4%2B-yellowgreen?style=plastic)

## Požiadavky

 - **PHP 7.4+**
 - Zapnuté PHP rozšírenia: **curl**.

## Použitie


```php    
use DiakritikAPI\DiakritikAPI;

require_once 'diakritikApi.class.php';  

$diakritik = new DiakritikAPI();

$text = "Krdel stastnych datlov uci kona zrat maso."

echo $diakritik->doplnDiakritiku($text);
// Vystup: 
// Kŕdeľ šťastných ďatľov učí koňa žrať mäso.
```
	
Metóda `doplnDiakritiku(..)` má aj druhý argument `$method`, kde môže byť jedna z nasledovných konštánt:

- DiakritikAPI::**METHOD_FIRST** 
- DiakritikAPI::**METHOD_RANDOM**
- DiakritikAPI::**METHOD_NAIVE** 
- DiakritikAPI::**METHOD_2GRAM**
- DiakritikAPI::**METHOD_3GRAM** 
- DiakritikAPI::**METHOD_4GRAM** *- default*
- DiakritikAPI::**METHOD_5GRAM** 
- DiakritikAPI::**METHOD_6GRAM**
- DiakritikAPI::**METHOD_SURREAL** 
- DiakritikAPI::**METHOD_MAXIMALIST**
- DiakritikAPI::**METHOD_REMOVE**

Tieto konštanty (metódy) určujú, akým spôsobom sa bude v texte dopĺňať diakritika. S výnimkou METHOD_REMOVE, ktorá odstraňuje diakritiku, sú všetky popísané na stránke [Jazykovedného ústavu Ľ. Štúra SAV](https://www.juls.savba.sk/diakritik.html).

## Test
Použitá metóda **4GRAM**.

| **Vstup**                                                                                                                                                                                                                                                                                                                                                       | **Výstup**                                                                                                                                                                                                                                                                                                                                                      |
|-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| *boolean*: true                                                                                                                                                                                                                                                                                                                                                   | *string*: ''                                                                                                                                                                                                                                                                                                                                                      |
| *boolean*: false                                                                                                                                                                                                                                                                                                                                                  | *string*: ''                                                                                                                                                                                                                                                                                                                                                      |
| *null*: NULL                                                                                                                                                                                                                                                                                                                                                      | *string*: ''                                                                                                                                                                                                                                                                                                                                                      |
| integer: 0                                                                                                                                                                                                                                                                                                                                                      | *string*: '0'                                                                                                                                                                                                                                                                                                                                                     |
| integer: 1                                                                                                                                                                                                                                                                                                                                                      | string: '1'                                                                                                                                                                                                                                                                                                                                                     |
| integer: 12345                                                                                                                                                                                                                                                                                                                                                  | *string*: '12345'                                                                                                                                                                                                                                                                                                                                                 |
| *string*: 'slovo'                                                                                                                                                                                                                                                                                                                                                 | *string*: 'slovo'                                                                                                                                                                                                                                                                                                                                                 |
| *string*: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'                                                                                                                                                                                                                                                                                              | *string*: 'Lorem ipsum dolor šiť amet, consectetur adipiscing elít.'                                                                                                                                                                                                                                                                                              |
| *string*: 'A quick brown fox jumps over the lazy dog.'                                                                                                                                                                                                                                                                                                            | *string*: 'A quick brown fox jumps over the lazy dôg.'                                                                                                                                                                                                                                                                                                            |
| *string*: 'Necht jiz hrisne saxofony dablu rozezvuci sin udesnymi tony waltzu, tanga a quickstepu.'                                                                                                                                                                                                                                                               | *string*: 'Necht již hrisne saxofóny dablu rozezvuci šiň udesnymi tony waltzu, tanga a quickstepu.'                                                                                                                                                                                                                                                               |
| *string*: 'Krdel stastnych datlov uci pri usti Vahu mlkveho kona obhryzat koru a zrat cerstve maso.'                                                                                                                                                                                                                                                              | *string*: 'Kŕdeľ šťastných ďatľov učí pri ústí Váhu mĺkveho koňa obhrýzať kôru a žrať čerstvé mäso.'                                                                                                                                                                                                                                                              |
| *string*: 'KRDEL STASTNYCH DATLOV UCI PRI USTI VAHU MLKVEHO KONA OBHRYZAT KORU A ZRAT CERSTVE MASO.'                                                                                                                                                                                                                                                              | *string*: 'KŔDEĽ ŠŤASTNÝCH ĎATĽOV UČÍ PRI ÚSTÍ VÁHU MĹKVEHO KOŇA OBHRÝZAŤ KÔRU A ŽRAŤ ČERSTVÉ MÄSO.'                                                                                                                                                                                                                                                              |
| *string*: 'Kupili sme si novy byt.'                                                                                                                                                                                                                                                                                                                               | *string*: 'Kúpili sme si nový byt.'                                                                                                                                                                                                                                                                                                                               |
| *string*: 'Byt, ci nebyt.'                                                                                                                                                                                                                                                                                                                                        | *string*: 'Byť, či nebyť.'                                                                                                                                                                                                                                                                                                                                        |



## Poďakovanie
[Jazykovedný ústav Ľudovíta Štúra Slovenskej akadémie vied](https://www.juls.savba.sk/)
