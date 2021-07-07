

################# PARAM ##################

*** config security.yml

	security:
		encoders:
			Symfony\Component\Security\Core\User\User: plaintext
			AC\ContactBundle\Entity\User: plaintext

		role_hierarchy:
			ROLE_ADMIN:       ROLE_USER

		providers:
			main:
				entity:
					class:    AC\ContactBundle\Entity\User
					property: username


		firewalls:

			dev:
				pattern: ^/(_(profiler|wdt)|css|images|js)/
				security: false

			main:
				pattern:   ^/
				anonymous: true
				provider:  main
				form_login:
					login_path: login
					check_path: login_check
					default_target_path: /contact/accueil
				logout:
					path:   logout
					target: /contact/accueil

*** app\config\routing.yml
	login:
		path: /login
		defaults:
			_controller: ACContactBundle:Default:login

	login_check:
		path: /login_check
		defaults:
			_controller: ACContactBundle:Default:accueil

	logout:
		path: /logout
		defaults:
			_controller: ACContactBundle:Default:accueil