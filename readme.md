## Text Process 
***
### Description : 
* Combine the most important sentences in that passage into a more complete short paragraph
* Use algorithm Stopword,TF-IDF,...


### Usage : 

* Install

```
composer require truongbo/textscore
```

* Use

```
<?php

use Truongbo\Textscore\Entities\ToParagraph;
use Truongbo\Textscore\TextProcessor;

include_once './vendor/autoload.php';

$text_score = (new TextProcessor())->process($input_text,$language);
echo ToParagraph::toParagraph($text_score, $limit);

```

* $input_text : The paragraph needs to be shortened
* $language : If it can't detect the language by itself, you can specify the language of the paragraph
* $limit : Desired number of sentences in the paragraph after being processed

### Input : 

```
------------------Input count 47 sentence-------------------------

Midfielder Nguyen Quang Hai has formally joined French club Pau FC after passing his medical on Wednesday.According to his agent, Nguyen Dac Van, it was done at the club's headquarter in Pyrénées-Atlantiques Province about 800 km from Paris.The 25-year-old star met the basic medical parameters related to muscle, heart rate, leg strength, speed, and endurance.Hai's two-year contract, with the option of extension for another year, came into effect then, making him the first Vietnamese player to play for a professional club in France.He wrote on social media: "The first important part has been completed. I have officially become a member of Pau FC from this moment. I'm very happy and proud."Pau are a small club with a stadium with a capacity of over 4,000. They also had the lowest payroll in the second division Ligue 2 at a total of €2.93 million (US$3 million) last season.But Hai is happy with his choice since he feels appreciated by the club and is likely to get a lot of playing time.Club vice president Joel Lopez said Pau are confident of developing rookies like Hai, and has promised to let the midfielder go to bigger teams if they receive a reasonable offer.In six seasons at Hanoi FC, Hai played 126 matches, scored 35 times and won every domestic title and the Vietnam Golden Ball in 2018.Hanoi offered Hai a new contract, but he remained steadfast about wanting to play abroad.He also played an important role in Vietnam winning the 2018 AFC U23 Championship's second place, the 2018 AFF Cup title and SEA Games 30 gold medal, and in Vietnam's journey to the final round of the 2022 World Cup qualifiers.Alexandre Castets, founder and moderator of Pau FC’s official fansite, said Vietnam’s top midfielder Nguyen Quang Hai will face great difficulties at his new club but could overcome them."European clubs rarely notice Asian players. I have watched videos of Quang Hai and he seemed really talented. The main concern is how he will adapt to a new country, language and football environment. Physique and stamina are also disadvantages for him," Castets said.
Castets created a website called 1959 (the establishing year of Pau FC) for the club and its supporters in 2008. He only learned about Hai through online videos but was impressed by his talent. Castets thinks Hai has what it takes to be a regular at Pau, and could be a replacement for Victor Lobry, the attacking midfielder that left the club this summer."Lobry's level is too good for Pau and many bigger clubs want him, so we cannot keep him at the club anymore. Lobry played as an attacking midfielder and it seems like Quang Hai will fill in his place," Castets added.However, Quang Hai will have to face stiff competition in this position from other players at the club. Castets said Steeve Beusnard and Eddy Silvestre can play as attacking midfielders, despite being central midfielders. The rookie Henri Saivet can also play in that position."Last season we also recruited a non-French player, midfielder Jovan Nisic from Serbia. He adapted really quickly so Pau can do the same for Quang Hai," he said.Castets also addressed the rumors about Hai's salary at Pau, as there were some sources who said he will receive an annual salary of around €200,000 to 300,000 ($210,000 to 315,000)."
That number is not realistic. It's four to five times higher than the average salary in the club. The annual budget of the club is only around €6.5 million. The number in the rumor will make Hai the highest-paid player on the team. But in this season, we have extra money from selling forward Samuel Essende so there is also a chance that Hai might get that number," he said.Hai is learning French, but he still needs a translator during the first few months at Pau. He is expected to undergo a medical Wednesday and after that, the contract will be activated.Vietnamese midfielder Nguyen Quang Hai had his first practice with French club Pau FC Thursday morning after officially joining the club Wednesday.he practice session began at 9:30 a.m. local time amid a light drizzle. Hai, the first Vietnamese to play for a professional club in France, and his teammates were present about 10 minutes earlier at the ground.Though Hai speaks no French, his greetings were warmly reciprocated. The players had a warm-up run for 20 minutes under the instructions of coach Didier Tholot.The club will have two practice sessions every weekday except Wednesday.A press conference was held the same afternoon to introduce the newcomers, including Hai. A friendly match with another team in Dax is scheduled for July 8, before the first match of the Ligue 2 on July 30.In six seasons with Hanoi FC, Hai played 126 matches, scored 35 times and won every domestic title and the Vietnam Golden Ball in 2018. He also played an important role in Vietnam winning the 2018 AFC U23 Championship's second place, the 2018 AFF Cup title and SEA Games 30 gold medal, and in Vietnam's journey to the final round of the 2022 World Cup qualifiers.Pau are a small club with a stadium capacity of over 4,000. They also have the lowest payroll in the second division Ligue 2 at a total of €2.93 million (US$3 million) last season.But Hai is happy with his choice since he feels appreciated by the club and is likely to get a lot of playing time.
```

### Output : 

```
------------------Output count 5 sentence-------------------------

Club vice president Joel Lopez said Pau are confident of developing rookies like Hai, and has promised to let the midfielder go to bigger teams if they receive a reasonable offer. He also played an important role in Vietnam winning the 2018 AFC U23 Championship's second place, the 2018 AFF Cup title and SEA Games 30 gold medal, and in Vietnam's journey to the final round of the 2022 World Cup qualifiers. Alexandre Castets, founder and moderator of Pau FC’s official fansite, said Vietnam’s top midfielder Nguyen Quang Hai will face great difficulties at his new club but could overcome them. Castets thinks Hai has what it takes to be a regular at Pau, and could be a replacement for Victor Lobry, the attacking midfielder that left the club this summer. He also played an important role in Vietnam winning the 2018 AFC U23 Championship's second place, the 2018 AFF Cup title and SEA Games 30 gold medal, and in Vietnam's journey to the final round of the 2022 World Cup qualifiers
```
