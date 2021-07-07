# Contact Form

Exercice technique / fonctionnel utilisé par ACSEO pour ses recrutements.


## Contexte

Vous êtes développeur chez ACSEO. Vous recevez une demande de la part d'un client pour la mise en place d'une nouvelle fonctionnalité sur son site Internet.


> Nous souhaiterions mettre en place un formulaire de contact sur notre site.
> Le formulaire de contact doit être simple : il doit nous permettre de connaitre les coordonnées de l'internaute, et sa question.
> Il nous faut au moins son nom, son email, et sa question pour que nous traitions sa demande.

> Il nous faudrait aussi un petit back-office avec accès sécurisé pour permettre au webmaster de consulter la liste des demandes, et de pouvoir cocher les messages que nous avons traité

Les règles de gestion suivantes sont à mettre en place :

> Un utilisateur qui dépose plusieurs demande de contact avec le même email, doit voir ses demandes regroupées et se cumulées pour ce contact

> Toute demande de contact doit déclencher la création d'un fichier JSON unique dans un répertoire spécifique non exposé par le serveur web, qui contient l'ensemble du contenu de la demande : informations du contact et contenu de la demande. A terme d'autres notifications seront déclenchées.

Il vous est demandé de mettre en place la solution sur la base du Framework Symfony.

#Guillaume Martin
## Travaux effectués

+Symfony 5.3
+MySql 8.0
+php 7.4



la route pour le formulaire est 
/personne/new

création d'un fichier Json lorsqu'une question est posée dans le dossier /var/contact

la route pour que l'utilisateur puisse voir toutes ses demandes : 
/personne/questions

executer dans MySql la requete sql :
>insert into contact.admin (id, email, roles, password) values (1, 'admin@contact.fr', '["ROLE_ADMIN"]', '$2y$13$eHK0nFkeF7EUyVbqQPfBbO5iG0QOms9Ah14OFOTFWBZ7FN6kIwCW.');

les credentials de admin sont :
>login : admin@contact.fr
>mdp : toor

la route pour se connecter à l'interface admin est /login

Je ne suis pas arrivé à mettre en forme le tableau en twig regroupant les questions des utilisateurs avec la validation.



