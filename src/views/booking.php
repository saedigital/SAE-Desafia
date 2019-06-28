<h4>Reserva de Poltronas</h4>

<h6>Reservas:</h6>

<table class="striped">
    <thead>
    <tr>
        <th>Cliente</th>
        <th>Espetáculo</th>
        <th>Data</th>
        <th>Local</th>
        <th>Polt. Reservadas</th>
        <th>Valor</th>
    </tr>
    </thead>

    <tbody>
    <?php foreach ($books as $book): ?>
        <tr>
            <td><?php echo $book['username'] ?></td>
            <td><?php echo $book['name'] ?></td>
            <td><?php echo $book['date'] ?></td>
            <td><?php echo $book['place'] ?></td>
            <td><?php echo $book['reservedSits'] ?></td>
            <td>R$: <?php echo $book['price'] * $book['reservedSits']; ?></td>
            <td class="right">
                <button class="btn waves-effect waves-light blue btn modal-trigger" href="#editBooking<?php echo $book['bookingId'] ?>"><i class="material-icons">edit</i></button>
                <a href="<?php echo BASE_URL."booking/deleteBook/".$book['bookingId']; ?>" class="btn waves-effect waves-light red"><i class="material-icons">remove</i></a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<div class="divider" style="margin-bottom: 50px"></div>
<div class="row">
    <a class="waves-effect waves-light btn modal-trigger right" href="#addBooking">Adicionar
        <i class="material-icons right">add</i></a>
</div>

<div id="addBooking" class="modal">
    <div class="modal-content">
        <h3>Reservar Espetáculo</h3>
        <div class="row">
            <form class="col s12" method="POST">
                <div class="row">
                    <div class="input-field col s12">
                        <input placeholder="Nome do responsável pela reserva" id="name" name="name" type="text" class="validate">
                        <label for="name">Nome</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <select name="show_id">
                            <option value="" disabled selected>Selecione o espetáculo:</option>
                            <?php foreach ($shows as $show): ?>
                            <option
                                value="<?php echo $show['id'] ?>"
                                <?php echo $show['reserved_sits'] >= $show['sits'] ? 'disabled' : '' ?>
                            ><?php echo $show['name'] . ' - ' . $show['date'] . ' | ' . $show['place'] ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                        <label>Espetáculos</label>
                    </div>
                    <div class="input-field col s6">
                        <input placeholder="Quantidade de Poltronas" id="sits" name="sits" type="number" class="validate">
                        <label for="sits">Quantidade de Poltronas</label>
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

<?php foreach ($books as $book) : ?>
<div id="editBooking<?php echo $book['bookingId'] ?>" class="modal">
    <div class="modal-content">
        <h3>Editar a reserva</h3>
        <div class="row">
            <form class="col s12" method="POST">
                <div class="row">
                    <div class="input-field col s12">
                        <input placeholder="Nome do responsável pela reserva" id="edit_name" name="edit_name" type="text" class="validate" value="<?php echo $book['username'] ?>">
                        <label for="name">Nome</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <select name="edit_show_id">
                            <option value="" disabled selected>Selecione o espetáculo:</option>
                            <?php foreach ($shows as $show): ?>
                                <option
                                    value="<?php echo $show['id'] ?>"
                                    <?php echo $show['reserved_sits'] >= $show['sits'] ? 'disabled' : '' ?>
                                    <?php echo $show['id'] == $book['show_id'] ? 'selected="selected"' : ''; ?>
                                ><?php echo $show['name'] . ' - ' . $show['date'] . ' | ' . $show['place'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <label>Espetáculos</label>
                    </div>
                    <div class="input-field col s6">
                        <input placeholder="Quantidade de Poltronas" id="edit_sits" name="edit_sits" type="number" class="validate" value="<?php echo $book['reservedSits'] ?>">
                        <label for="sits">Quantidade de Poltronas</label>
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
    <a class="waves-effect waves-light btn" href="/show">Espetáculos</a>
</div>

