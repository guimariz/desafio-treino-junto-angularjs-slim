var app = angular.module('crudApp', ['datatables']);
app.controller('crudController', function ($scope, $http) {
  $scope.success = false;

  $scope.error = false;

  $scope.fetchData = function () {
    $http.get('http://localhost:8001/clients').success(function (data) {
      $scope.clientData = data;
    });
  };

  $scope.openModal = function () {
    var modalPopup = angular.element('#crudmodal');
    modalPopup.modal('show');
  };

  $scope.closeModal = function () {
    var modalPopup = angular.element('#crudmodal');
    modalPopup.modal('hide');
    $scope.client_name = '';
    $scope.client_cep = '';
    $scope.client_bairro = '';
    $scope.client_cidade = '';
    $scope.client_estado = '';
    $scope.client_logradouro = '';
    $scope.client_cpf = '';
    $scope.client_numero = '';
    $scope.action = '';
    $scope.id = '';
  };

  $scope.addData = function () {
    $scope.modalTitle = 'Adicionar Cliente';
    $scope.submitButton = 'Insert';
    $scope.openModal();
  };

  $scope.submitForm = function () {
    $http({
      method: 'POST',
      url: 'http://localhost:8001/clients',
      data: {
        client_name: $scope.client_name,
        client_cep: $scope.client_cep,
        client_bairro: $scope.client_bairro,
        client_cidade: $scope.client_cidade,
        client_estado: $scope.client_estado,
        client_logradouro: $scope.client_logradouro,
        client_cpf: $scope.client_cpf,
        client_numero: $scope.client_numero,
        action: $scope.submitButton,
        id: $scope.hiddenId,
      },
    }).success(function (data) {
      console.log(data);
      if (data.error != '') {
        $scope.success = false;
        $scope.error = true;
        $scope.errorMessage = data.error;
      } else {
        $scope.success = true;
        $scope.error = false;
        $scope.successMessage = data.message;
        $scope.formData = {};
        $scope.closeModal();
        $scope.fetchData();
      }
    });
  };

  $scope.getCorreios = function () {
    if ($scope.client_cep.length === 8) {
      $http({
        method: 'GET',
        url: `https://viacep.com.br/ws/${$scope.client_cep}/json`,
      }).success(function (data) {
        if (data.erro) {
          $scope.success = false;
          $scope.error = true;
          $scope.errorMessage = 'CEP inválido';
        } else {
          $scope.client_bairro = data.bairro;
          $scope.client_cidade = data.localidade;
          $scope.client_estado = data.uf;
          $scope.client_logradouro = data.logradouro;
          $scope.error = false;
          $scope.errorMessage = '';
        }
      });
    }
  };

  $scope.fetchSingleData = function (id) {
    $http({
      method: 'POST',
      url: 'http://localhost:8001/clients',
    }).success(function (data) {
      let edit = data.find((edit) => edit.id === id);
      $scope.client_name = edit.name;
      $scope.client_cep = edit.cep;
      $scope.client_bairro = edit.bairro;
      $scope.client_cidade = edit.cidade;
      $scope.client_estado = edit.estado;
      $scope.client_logradouro = edit.logradouro;
      $scope.client_cpf = edit.cpf;
      $scope.client_numero = edit.numero;
    });
    $http({
      method: 'POST',
      url: 'http://localhost:8001/clients',
      data: { id: id, action: 'fetch_single_data' },
    }).success(function () {
      $scope.modalTitle = 'Edit Data';
      $scope.submitButton = 'Edit';
      $scope.openModal();
      $scope.hiddenId = id;
    });
  };

  $scope.deleteData = function (id) {
    if (confirm('Deseja remover o cliente?')) {
      $http({
        method: 'POST',
        url: 'http://localhost:8001/clients',
        data: { id: id, action: 'Delete' },
      }).success(function (data) {
        $scope.success = true;
        $scope.error = false;
        $scope.successMessage = data.message;
        $scope.fetchData();
      });
    }
  };
});
