angular.module('starter')
.controller('Controller', function($scope, $localStorage, UsuarioService, $ionicPopup, $state){

    //Retorna usuario service -> local storage
    $scope.usuario = $localStorage.usuario;

    //Função de logoff e remove usuario local storage
    $scope.logoff = function(usuario){
        var usuarios = UsuarioService.getUsuario();

        for(var i in usuarios){
            if(usuario.id == usuarios[i].id){
                usuario.splice(i, 1);
            }
        }

        UsuarioService.setUsuario();

        $ionicPopup.alert({
            title: 'Saiu',
            template: 'Usuário fez logoff'
        }).then(function(){
            location.reload();
		    $state.go("login");
        });
    }
});

