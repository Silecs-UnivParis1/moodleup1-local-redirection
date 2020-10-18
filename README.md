Plugin `local_redirection` [M#3066](https://tickets.silecs.info/view.php?id=3066).
(C) 2013-2020  Silecs

Ce plugin fonctionne nativement à l'adresse
<http://moodle.example.com/local/redirection/index.php?target=[url-perenne]>
et redirige le navigateur (weblib/redirect) vers le cours correspondant.

Ce plugin a trois compagnons :

* `local/up1_metadata` (màj) ajoute une métadonnée de cours `up1urlfixe`, que ce soit en installation (instance neuve) ou en mise à jour
* `report_up1urlfixe` affiche la synthèse sur les redirections existantes, y compris les problèmes (doublons)
* `local/crswizard` (màj) : intègre le champ à `up1urlfixe` à renseigner dans l'assistant
