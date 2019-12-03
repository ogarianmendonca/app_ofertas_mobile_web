angular.module('starter')
    .service('Base', function ($http) {
        this.baseUrl = "http://localhost:8000/api/";
        //this.baseUrl = "https://upofertas-app.000webhostapp.com/api/";

        this.paramsPost = {headers: {'Content-Type': undefined }, transformRequest: angular.identity};
        return this;
    })

    .service('WebService', function ($localStorage, $http, Base) {
        //Retorna as ofertas da API
        var _getOfertas = function (scope) {
            $http.get( Base.baseUrl + 'ofertas').then(
                function (retorno) {
                    $localStorage.ofertas = retorno.data;
                    scope.ofertas = retorno.data;
                    return;
                }, function (erro) {
                    alert('Ocorreu algum erro, tente novamente mais tarde');
                });
        };

        //Retorna os favoritos adicionados local storage
        var _getFavoritos = function () {
            if (!$localStorage.favoritos) {
                $localStorage.favoritos = [];
            }
            return $localStorage.favoritos;
        };

        //Adiciona os favoritos local storage
        var _setFavoritos = function (favoritos) {
            $localStorage.favoritos = favoritos;
        };

        return {
            getOfertas: _getOfertas,
            getFavoritos: _getFavoritos,
            setFavoritos: _setFavoritos
        };
    })

    .service('UsuarioService', function ($localStorage, $http) {
        //Adiciona usuario local storage
        var _setUsuario = function (usuario) {
            $localStorage.usuario = usuario;
        };

        //Recupera usuario local storage
        var _getUsuario = function () {
            return $localStorage.usuario;
        };

        return {
            setUsuario: _setUsuario,
            getUsuario: _getUsuario,
        };
    })

    .service('UsuariosService', function($http, Base){

        this.retornaUsuarios = function(params){
            return $http.get(Base.baseUrl + 'usuarios', params);
        };

        return this;

    })

    .service('MensagemService', function ($http, Base) {
        this.mensagens = function(params){
            return $http.get(Base.baseUrl + 'mensagens/' + params);
        };

        this.visualizar = function(params){
            return $http.get(Base.baseUrl + 'visualizar-mensagem/' + params);
        };

        this.nova = function(params){
            return $http.get(Base.baseUrl + 'nova-mensagem', params);
        };

        this.excluir = function(params){
            console.log(params);
            return $http.get(Base.baseUrl + 'excluir-mensagem/' + params.params);
        };

        return this;
    })