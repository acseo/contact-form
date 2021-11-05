###Instalation

####DB configuration
 Set up your mysql config in you .env file

( symfony can be replace by php bin/console following your config)
 then run :
 ``````bash
 #only in local/dev if schema doesn't exist yet
 symfony console doctrine:schema:create 
 
 
 symfony console doctrine:schema:update
 
 #load fixture base message & user admin ( login admin@admin.fr pass  acseo )
 #load fixture base message & user admin ( login admin@admin.fr pass  acseo )
 symfony console doctrine:fixtures:load
 
 
 ``````

maybe change the Json message path in parameters 
````yaml
#default is defined  in /config/services.yaml and will put files in a folder contactMessages
parameters:
  app.contact_messages: '%kernel.project_dir%\contactMessages\'
````
#### Start symfony server
 ``````bash
 #start symfony web server
 symfony serve
 ``````