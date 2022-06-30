## Text Process 
***
### Description : 
* Combine the most important sentences in that passage into a more complete short paragraph
* Use algorithm Stopword,TF-IDF,...


### Usage : 

```
<?php

use Truongbo\Textscore\Entities\ToParagraph;
use Truongbo\Textscore\TextProcessor;

include_once './vendor/autoload.php';

$file_content = fopen("./input.txt", "r") or die("Unable to open file!");
$text =  fread($file_content,filesize("./input.txt"));
fclose($file_content);

$text_score = (new TextProcessor())->process($text);

echo ToParagraph::toParagraph($text_score, 5);

```

* input_text : The paragraph needs to be shortened
* limit : Desired number of sentences in the paragraph after being processed

### Input : 

```
File : input.txt
```

### Output : 

```
Piles of luggage beside baggage belts in airports from Canada to Europe are driving further demand for ground handlers, 
and adding to summer travel chaos as airlines scramble to bring back workers lost during Covid-19. The International 
Association of Machinists and Aerospace Workers (IAMAW), which represents ground handlers, including baggage and cargo 
handlers, for Air Canada among other carriers, said some Canadian workers are being offered raises and double pay to 
work beyond eight-hour shifts, a union official said. Flowers said there is no one explanation for the lost baggage,
which is rather the result of staff shortages and flight delays that have created a "spiral effect," resulting in cases 
of passengers waiting up to seven days to get their bags back. Fabio Gamba, director of the Airport Services Association
, a trade group for the independent ground and air cargo handling industry, estimated that in 2019 there were roughly 
220,000 to 240,000 people in ground handling in Europe. Air Canada, which has its own employees who handle baggage at 
Toronto's Pearson International Airport, said the resumption in travel has led to "more instances of delayed bags" as 
passenger numbers surge
```