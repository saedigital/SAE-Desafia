<div class="row">
  <div class="col-sm-3 offset-sm-2">

  <?php echo form_open(base_url('admin/login')) ?>

    <div class="form-group">
      <label for="email">E-mail</label>
      <input type="email" name="email" id="email" autocomplete="off" class="form-control">
    </div>

    <div class="form-group">
      <label for="email">Senha</label>
      <input type="password" name="password" id="password" autocomplete="off" class="form-control">
    </div>

    <div class="form-group">
      <input type="submit" class="btn btn-primary" value="Entrar">
    </div>

  <?php echo form_close() ?>

  </div>

  <div class="col-sm-6">

    <div class="card bg-default help">
      <div class="card-header">
        <h5>Instruções</h5>
      </div>
      <div class="card-body">
        <div class="card-text">
          <p>O sistema possui dois usuários padrão, <strong>Administrador</strong> e <strong>Cliente</strong>.</p>
          <div class="row">
            <div class="col-lg-6">
              <!-- acesso admin -->
              <div class="card bg-dark text-light">
                <div class="card-header">
                  Acesso de <strong>Administrador</strong>
                </div>
                <div class="card-body">
                  <ul>
                    <li><strong>E-mail: </strong>admin@admin.com</li>
                    <li><strong>Senha: </strong>admin</li>
                  </ul>
                </div>
                <div class="card-footer">
                  <small><strong>Observação:</strong> Após o login será encaminhado para a área administrativa.</small>
                </div>
              </div>

            </div>
            <div class="col-lg-6">
              <!-- acesso admin -->
              <div class="card bg-info text-light">
                <div class="card-header">
                  Acesso de <strong>Cliente</strong>
                </div>
                <div class="card-body">
                  <ul>
                    <li><strong>E-mail: </strong>client@client.com</li>
                    <li><strong>Senha: </strong>client</li>
                  </ul>
                </div>
                <div class="card-footer">
                  <small><strong>Observação:</strong> Após o login será encaminhado para a área de espetáculos.</small>
                </div>
              </div>

            </div>
          </div>

          <p>Para o <strong>Administrador</strong> é permitido:</p>
          <ul>
            <li>Criar novos espetáculos;</li>
            <li>Editar espetáculos já existentes;</li>
            <li>Excluir espetáculos;</li>
            <li>Visualizar histórico de vendas e dados financeiros.</li>
            <li>Todas as atribuições de <strong>Cliente</strong>;</li>
          </ul>
          <p>Para o <strong>Cliente</strong> é permitido:</p>
          <ul>
            <li>Visualizar os espetáculos e disponibilidade de poltronas;</li>
            <li>Reservar uma ou mais poltronas;</li>
            <li>Excluir suas próprias reservas.</li>
          </ul>


        </div>
      </div>
    </div>

  </div>
</div>
