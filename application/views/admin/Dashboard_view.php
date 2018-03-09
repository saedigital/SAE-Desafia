<div class="row">
  <div class="col-lg-8">
    <!-- dashboard -->
    <div class="card-deck">
      <!-- shows -->
      <div class="card bg-info">
        <div class="card-header"><h5>Espetáculos</h5></div>
        <div class="card-body">
          <?php if($total_shows > 0): echo '<p>'.$total_shows.' espetáculos cadastrados</p><p><a href="'.base_url('admin/shows').'">Ver todos</a></p>'; else: ?>
            <p>Ainda não há espetáculos cadastrados.</p>
          <?php endif; ?>
        </div>
        <div class="card-footer">
          <a href="<?php echo base_url('admin/shows/insert') ?>" class="btn btn-sm btn-light text-info"><i class="oi oi-plus"></i> Cadastrar espetáculo</a>
        </div>
      </div>
      <!-- seats -->
      <div class="card bg-success">
        <div class="card-header"><h5>Poltronas</h5></div>
        <div class="card-body">
          <?php if($total_seats > 0): echo '<p>'.$total_seats.' poltronas disponíves</p>'; else: ?>
            <p>Não há poltronas.</p>
          <?php endif; ?>
          <?php if($total_enabled_seats > 0): echo '<p>'.$total_enabled_seats.' poltronas disponíves</p>'; else: ?>
            <p>Não há poltronas disponíveis.</p>
          <?php endif; ?>
          <?php if($total_disabled_seats > 0): echo '<p>'.$total_disabled_seats.' poltronas reservadas</p>'; else: ?>
            <p>Não há poltronas reservadas.</p>
          <?php endif; ?>
        </div>
      </div>
      <!-- money -->
      <div class="card bg-warning">
        <div class="card-header"><h5>Financeiro</h5></div>
        <div class="card-body">
          <?php if($total_sold > 0): echo '<p>R$ '.number_format($total_sold, 2, ',', '.').' arrecadados</p>'; else: ?>
            <p>Não houve arrecadação.</p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4">
    <!-- instruções -->
    <div class="card bg-default help">
      <div class="card-header">
        <h5>Observações</h5>
      </div>
      <div class="card-body">
        <p>Foram feitas para este dashboard apenas somas simples.</p>
        <p>O custo padrão da poltrona é de <strong>R$ 23,76</strong> conforme solicitado. Está em <em>hardcode</em> no <em>input</em> do formulário de inclusão de novo espetáculo, podendo ser editado posteriormente. Caso o custo da poltrona seja alterado as vendas já realizadas terão o valor preservado.</p>
        <p>A quantidade de poltronas também é variável mas ocorrerá erro caso reduzido numa quantidade menor do que já foi reservado.</p>
      </div>
    </div>
  </div>
</div>
