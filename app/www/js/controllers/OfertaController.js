angular.module('starter')
  .controller('OfertaController', function ($scope, WebService, $ionicPopup, $timeout, $ionicListDelegate) {
    // Retorna os ofertas do service
    WebService.getOfertas($scope);

    $scope.errorAddFavorito = function () {
      var alertPopup = $ionicPopup.alert({
        title: 'Ops!',
        template: 'Já existe uma oferta adicionada aos favoritos.'
      })
    };

    $scope.sucessoAddFavorito = function () {
      var alertPopup = $ionicPopup.alert({
        title: 'Muito bem!',
        template: 'Oferta adicionada aos favoritos!'
      })
    };

    // Função adicionar ofertas ao favoritos
    $scope.addFavoritos = function (oferta) {
      var favoritos = WebService.getFavoritos();

      for (var i in favoritos) {
        if (oferta.id == favoritos[i].id) {

          $scope.errorAddFavorito();
          $ionicListDelegate.closeOptionButtons();
          return;
        }
      }

      favoritos.push(oferta);
      WebService.setFavoritos(favoritos);
      $scope.sucessoAddFavorito();
      $ionicListDelegate.closeOptionButtons();
    };
  });
