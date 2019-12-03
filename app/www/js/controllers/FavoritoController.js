angular.module('starter')
.controller('FavoritoController', function($scope, WebService, $ionicPopup, $timeout, $ionicListDelegate){

    // Retorna os favoritos do service
    $scope.favoritos = WebService.getFavoritos();

    $scope.removeOferta = function(){
        var alertPopup = $ionicPopup.alert({
            title: 'Ok!',
            template: 'Oferta removida dos favoritos!'
        })
    };

    // Função remove ofertas de favoritos
    $scope.removeFavoritos = function(oferta){
        var favoritos = WebService.getFavoritos();

        for(var i in favoritos){
            if(oferta.id == favoritos[i].id){
                favoritos.splice(i, 1);
            }
        }

        WebService.setFavoritos(favoritos);
        $scope.removeOferta();
        $ionicListDelegate.closeOptionButtons();
    };

});
