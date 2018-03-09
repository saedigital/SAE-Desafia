<?php
$config = [

  'login' => [
    [
      'field' => 'email',
      'label' => 'E-mail',
      'rules' => 'trim|required',
      'messages' => [
        'required' => 'O e-mail é obrigatório',
      ],
    ],[
      'field' => 'password',
      'label' => 'Senha',
      'rules' => 'trim|required',
      'messages' => [
        'required' => 'A senha é obrigatória',
      ],
    ],
  ],

  'show_fieds' => [
    [
      'field' => 'title',
      'label' => 'Título',
      'rules' => 'trim|required',
      'messages' => [
        'required' => 'O título é obrigatório'
      ],
    ],[
      'field' => 'seating_total',
      'label' => 'Total de assentos',
      'rules' => 'trim|max_length[4]|greater_than_equal_to[1]|less_than_equal_to[9999]|required',
      'messages' => [
        'max_length' => 'Digite um valor com até 4 dígitos',
        'greater_than_equal_to' => 'Digite um número maior ou igual a 1',
        'less_than_equal_to' => 'Digite um número menor que 9999',
        'required' => 'O total de assentos é obrigatório',
      ],
    ],[
      'field' => 'seating_value',
      'label' => 'Valor do assento',
      'rules' => 'trim|greater_than_equal_to[1]|less_than_equal_to[9999]|required',
      'messages' => [
        'greater_than_equal_to' => 'Digite um número maior ou igual a 1',
        'less_than_equal_to' => 'Digite um número menor que 9999',
        'required' => 'O total de assentos é obrigatório',
      ],
    ],[
      'field' => 'start_date',
      'label' => 'Data de início',
      'rules' => 'trim|required',
      'messages' => [
        'required' => 'A data de início é obrigatória',
      ],
    ],[
      'field' => 'start_time',
      'label' => 'Hora de início',
      'rules' => 'trim|required',
      'messages' => [
        'required' => 'A hora de início é obrigatória',
      ],
    ],[
      'field' => 'duration',
      'label' => 'Duração',
      'rules' => 'trim|required',
      'messages' => [
        'required' => 'A duração é obrigatória',
      ],
    ],
  ], // show fields

];
