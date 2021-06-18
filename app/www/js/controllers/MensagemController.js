angular.module('starter')
  .controller('MensagemController', function ($scope, $http, $localStorage, $state, $ionicModal, $ionicPopup, $ionicListDelegate, Base, UsuarioService, MensagemService, UsuariosService) {
    $scope.usuario = $localStorage.usuario;

    //retorna todos os usuarios
    $scope.usuarios = [];
    $scope.todosUsuarios = function () {
      UsuariosService.retornaUsuarios().success(function (result) {
        $scope.usuarios = result;
      });
    };
    $scope.todosUsuarios();

    //Busca todas as mensagens
    $scope.mensagens = [];
    $scope.buscaMensagens = function () {
      MensagemService.mensagens($scope.usuario[0]['id']).success(function (result) {
        $scope.mensagens = result.mensagens;
      });
    };
    $scope.buscaMensagens();

    //Modal visualizar mensagem
    $ionicModal.fromTemplateUrl('modal-visualizar-mensagem.html', {
      scope: $scope,
      animation: 'slide-in-up'
    }).then(function (modal) {
      $scope.modal = modal;
    });

    //função abrir modal
    $scope.abreModal = function () {
      $scope.modal.show();
    };

    //função fecha modal
    $scope.fechaModal = function () {
      $scope.modal.hide();
    };

    //função para visualizar uma mensagem
    $scope.visualizarMensagem = [];
    $scope.visualizar = function (id) {
      MensagemService.visualizar(id).success(function (result) {
        $scope.visualizarMensagem = result;
        $scope.abreModal();
      });
    };

    //função para enviar mensagem
    $scope.novaMensagem = [];
    $scope.nova = function (novaMensagem) {
      if (novaMensagem.mensagem == undefined || novaMensagem.mensagem == "") {
        $ionicPopup.alert({
          title: 'Ops!',
          template: "Preencha todos os campos"
        }).then(function () {
        });
      } else {
        novaMensagem.de = $scope.usuario[0]['id'];
        MensagemService.nova({'params': novaMensagem}).success(function (result) {
          $ionicPopup.alert({
            title: 'Muito bem!',
            template: result.result
          }).then(function () {
            $state.go('app.mensagens');
            location.reload();
          });
        }).error(function () {
          $ionicPopup.alert({
            title: 'Ops!',
            template: 'Ocorreu um erro, tente mais tarde'
          }).then(function () {
            $state.go('app.mensagens');
          });
        });
      }
    };

    $scope.excluir = function (id) {
      console.log(id);
      MensagemService.excluir({'params': id}).success(function (result) {
        $ionicPopup.alert({
          title: 'Muito bem!',
          template: result.result
        }).then(function () {
          $ionicListDelegate.closeOptionButtons();
          location.reload();
        });
      }).error(function () {
        $ionicPopup.alert({
          title: 'Ops!',
          template: 'Ocorreu um erro, tente mais tarde'
        }).then(function () {
          $ionicListDelegate.closeOptionButtons();
        });
      });
    };

    $scope.irNovaMensagem = function () {
      $scope.fechaModal();
      $state.go('app.nova-mensagem');
    };
  });
