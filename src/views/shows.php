<h3>Espetáculos</h3>

<table class="striped">
    <thead>
    <tr>
        <th>Nome</th>
        <th>Data</th>
        <th>Local</th>
        <th>Qtd. Poltronas</th>
        <th>Polt. Reservadas</th>
        <th>Preço</th>
        <th>Valor Arrecadado</th>
        <th></th>
    </tr>
    </thead>

    <tbody>
    <?php foreach ($shows as $show): ?>
    <tr>
        <td><?php echo $show['name'] ?></td>
        <td><?php echo $show['date'] ?></td>
        <td><?php echo $show['place'] ?></td>
        <td><?php echo $show['sits'] ?></td>
        <td><?php echo $show['reserved_sits'] ?></td>
        <td>R$: <?php echo $show['price'] ?></td>
        <td>R$: <?php echo $show['price'] * $show['reserved_sits']; ?></td>
        <td class="right">
            <button class="btn waves-effect waves-light blue btn modal-trigger" href="#editShow<?php echo $show['id'] ?>"><i class="material-icons">edit</i></button>
            <a href="<?php echo BASE_URL."show/deleteShow/".$show['id']; ?>" class="btn waves-effect waves-light red"><i class="material-icons">remove</i></a>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<div class="divider" style="margin-bottom: 50px"></div>
<div class="row">
    <a class="waves-effect waves-light btn modal-trigger right" href="#addShow">Adicionar
        <i class="material-icons right">add</i></a>
</div>

<div id="addShow" class="modal">
    <div class="modal-content">
        <h3>Editar Espetáculo</h3>
        <div class="row">
            <form class="col s12" method="POST">
                <div class="row">
                    <div class="input-field col s6">
                        <input placeholder="Nome do Espetáculo" id="name" name="name" type="text" class="validate">
                        <label for="name">Nome do Espetáculo</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="date" name="date" type="datetime-local" class="">
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input placeholder="Local do Espetáculo" id="place" name="place" type="text" class="validate">
                        <label for="place">Local do Espetáculo</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <input placeholder="Quantidade de Poltronas" id="sits" name="sits" type="number" class="validate">
                        <label for="sits">Quantidade de Poltronas</label>
                    </div>
                    <div class="input-field col s6">
                        <input placeholder="Preço" id="price" name="price" type="number" class="validate" step=".01">
                        <label for="price">Preço R$:</label>
                    </div>
                </div>
                <div class="row">
                    <button class="right btn waves-effect waves-light" type="submit">Salvar
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php foreach ($shows as $show): ?>
    <div id="editShow<?php echo $show['id'] ?>" class="modal">
        <div class="modal-content">
            <h3>Inserir Espetáculo</h3>
            <div class="row">
                <form class="col s12" method="POST">
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="hidden" id="id" name="edit_id" value="<?php echo $show['id']; ?>">
                            <input placeholder="Nome do Espetáculo" id="name" name="edit_name" type="text" class="validate" value="<?php echo $show['name'] ?>">
                            <label for="name">Nome do Espetáculo</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="date" name="edit_date" type="datetime-local"  value="<?php date("c", strtotime($show['date'])) ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input placeholder="Local do Espetáculo" id="place" name="edit_place" type="text" class="validate"  value="<?php echo $show['place'] ?>">
                            <label for="place">Local do Espetáculo</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input placeholder="Quantidade de Poltronas" id="sits" name="edit_sits" type="number" class="validate"  value="<?php echo $show['sits'] ?>">
                            <label for="sits">Quantidade de Poltronas</label>
                        </div>
                        <div class="input-field col s6">
                            <input placeholder="Preço" id="price" name="edit_price" type="number" class="validate" step=".01"  value="<?php echo $show['price'] ?>">
                            <label for="price">Preço R$:</label>
                        </div>
                    </div>
                    <div class="row">
                        <button class="right btn waves-effect waves-light" type="submit">Salvar
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<div class="row">
    <a class="waves-effect waves-light btn" href="/booking">Reservas</a>
</div>