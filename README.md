Plugin `local_redirection` [M#3066](https://tickets.silecs.info/view.php?id=3066).
(C) 2016-2020  Silecs

Ce plugin fonctionne nativement à l'adresse
<http://moodle.example.com/local/redirection/index.php?target=[url-perenne]>
et redirige le navigateur (weblib/redirect) vers le cours correspondant.

Ce plugin a deux compagnons :

* `local/up1_metadata` ajoute une métadonnée de cours `up1urlfixe`, que ce soit en installation (instance neuve) ou en mise à jour
* `local/crswizard`  intègre dans l'assistant de création de cours le champ `up1urlfixe` à renseigner
