angular.module('starter')
.controller('LoginController', function($scope, $http, $state, $ionicPopup, UsuarioService, Base){

    $scope.logarUsuario = function(){
        var dados = {'email': this.email, 'password' : this.password};

        $http({
            method: 'GET',
            url: Base.baseUrl + 'users/' + dados.email + '/' + dados.password,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(data){
            $scope.usuario = data.users;
            if(data.success = true) {
                $ionicPopup.alert({
					title: 'Olá!',
					template: 'Bem-vindo(a) ' + data.users[0]['name']
				}).then(function(){
                    $state.go('app.ofertas');
                });

                UsuarioService.setUsuario(data.users);
            } else {
                $ionicPopup.alert({
                    title: 'Ops!',
                    template: data.msgError
                });
            }
        }).error(function(){
            $ionicPopup.alert({
                title: 'Ops!',
                template: 'E-mail ou senha está incorreto.'
            });
        });

    };

});