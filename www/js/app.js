angular.module('starter', ['ionic', 'ngStorage'])

    .run(function ($ionicPlatform) {
        $ionicPlatform.ready(function () {

            if (window.cordova && window.Keyboard) {
                window.Keyboard.hideKeyboardAccessoryBar(true);
            }

            if (window.StatusBar) {
                StatusBar.styleDefault();
            }
        });
    })

    // Rotas do aplicativo
    .config(function ($stateProvider, $urlRouterProvider) {

        $stateProvider
            .state('app', {
                url: '/app',
                abstract: true,
                templateUrl: 'templates/app.html',
                controller: 'Controller'
            })

            .state('login', {
                url: '/login',
                templateUrl: 'templates/login.html',
                controller: 'LoginController'
            })

            .state('app.ofertas', {
                url: '/ofertas',
                views: {
                    'menuContent': {
                        templateUrl: 'templates/ofertas.html',
                        controller: 'OfertaController'
                    }
                }
            })

            .state('app.favoritos', {
                url: '/favoritos',
                views: {
                    'menuContent': {
                        templateUrl: 'templates/favoritos.html',
                        controller: 'FavoritoController'
                    }
                }
            })

            .state('app.mensagens', {
                url: '/mensagens',
                views: {
                    'menuContent': {
                        templateUrl: 'templates/mensagens.html',
                        controller: 'MensagemController'
                    }
                }
            })

            .state('app.nova-mensagem', {
                url: '/nova-mensagem',
                views: {
                    'menuContent': {
                        templateUrl: 'templates/nova-mensagem.html',
                        controller: 'MensagemController'
                    }
                }
            });

        // Configurar rota padrão
        $urlRouterProvider.otherwise('login');
        // $urlRouterProvider.otherwise('app/ofertas');

    })
