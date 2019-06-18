import { Request, Response, Application, Router } from "express";
import { Espetaculo, IEspetaculo, SchemaEspetaculo } from "Entities/Espetaculo";
import { check } from "express-validator/check";
import { Validate } from "../Validate";
import { UNPROCESSABLE_ENTITY, OK } from "http-status-codes";
import { Reserva } from "Entities/Reserva";
import { ErrorMessage } from "ErrorMessage";

export class ControllerEspetaculos {
  public registrarEndpoints(router: Router) {
    router.get("/espetaculos", this.getEspetaculos);

    router.post(
      "/espetaculo",
      check("_id")
        .optional()
        .isString(),
      check("nome")
        .exists()
        .isString()
        .not()
        .isEmpty(),
      check("numeroAssentos")
        .exists()
        .isNumeric(),
      Validate,
      this.postEspetaculo
    );

    router.get("/espetaculo/:id", Validate, this.getEspetaculo);

    router.delete("/espetaculo/:id", Validate, this.deleteEspetaculo);

    router.post(
      "/espetaculo/:id/reservar",
      check("nomePessoa")
        .exists()
        .not()
        .isEmpty()
        .isString(),
      check("email")
        .exists()
        .not()
        .isEmpty()
        .isEmail(),
      check("numeroCadeira")
        .exists()
        .not()
        .isEmpty()
        .isNumeric(),
      Validate,
      this.postReservar
    );

    router.delete(
      "/espetaculo/:idEspetaculo/reserva/:idReserva",
      Validate,
      this.deleteReserva
    );
  }

  public async getEspetaculo(request: Request, response: Response) {
    const espetaculo = await Espetaculo.findById(request.params.id)
      .select("-reservas.nomePessoa -reservas.email")
      .exec();

    if (espetaculo) {
      response.status(OK).send(espetaculo);
    } else {
      response.status(UNPROCESSABLE_ENTITY).send();
    }
  }

  public async getEspetaculos(request: Request, response: Response) {
    const espetaculos = await Espetaculo.find()
      .select({
        nome: 1
      })
      .exec();
    response.status(OK).send(espetaculos);
  }

  public async postEspetaculo(request: Request, response: Response) {
    let espetaculo: IEspetaculo | null = null;

    if (request.body._id) {
      espetaculo = await Espetaculo.findById(request.body._id);

      if (!espetaculo) {
        response.status(UNPROCESSABLE_ENTITY).send(new ErrorMessage("Espetáculo não existente"));
        return;
      }

      if (espetaculo.reservas.length > 0 && espetaculo.numeroAssentos != request.body.numeroAssentos){
        response.status(UNPROCESSABLE_ENTITY).send(new ErrorMessage("Não é possível mudar a quantidade de assentos depois que houverem reservas"));
        return;
      }
    } else {
      espetaculo = new Espetaculo();
    }

    espetaculo.nome = request.body.nome;
    espetaculo.numeroAssentos = request.body.numeroAssentos;
    espetaculo.preco = 23.76;

    await espetaculo.save();

    response.status(OK).send();
  }

  public async deleteEspetaculo(request: Request, response: Response) {
    const espetaculo = await Espetaculo.findById(request.params.id).exec();

    if (!espetaculo) {
      response.status(UNPROCESSABLE_ENTITY).send(new ErrorMessage("Espetáculo não existente"));
      return;
    }

    for (const reserva of espetaculo.reservas) {
      // Enviar um email de cancelamento
    }

    await espetaculo.remove();
    response.status(OK).send();
  }

  public async postReservar(request: Request, response: Response) {
    const espetaculo = await Espetaculo.findById(request.params.id).exec();

    if (!espetaculo) {
      response.status(UNPROCESSABLE_ENTITY).send(new ErrorMessage("Espetáculo não existente"));
      return;
    }

    const nomePessoa = request.body.nomePessoa;
    const email = request.body.email;
    const numeroCadeira = request.body.numeroCadeira;

    if (numeroCadeira <= 0 || numeroCadeira > espetaculo.numeroAssentos) {
      response.status(UNPROCESSABLE_ENTITY).send(new ErrorMessage("Número de cadeira inválido"));
      return;
    }

    const reservaComMesmaCadeira = espetaculo.reservas.find(
      reserva => reserva.numeroCadeira === numeroCadeira
    );
    if (reservaComMesmaCadeira) {
      response.status(UNPROCESSABLE_ENTITY).send(new ErrorMessage("Já existe uma reserva com esse número de cadeira"));
      return;
    }

    const reserva = new Reserva();
    reserva.nomePessoa = nomePessoa;
    reserva.email = email;
    reserva.numeroCadeira = numeroCadeira;

    espetaculo.reservas.push(reserva);
    await espetaculo.save();

    response.status(OK).send();
  }

  public async deleteReserva(request: Request, response: Response) {
    const espetaculo = await Espetaculo.findById(
      request.params.idEspetaculo
    ).exec();

    if (!espetaculo) {
      response.status(UNPROCESSABLE_ENTITY).send(new ErrorMessage("Espetáculo não existente"));
      return;
    }

    const reserva = espetaculo.reservas.id(request.params.idReserva);
    if (!reserva) {
      response.status(UNPROCESSABLE_ENTITY).send(new ErrorMessage("Reserva não existente"));
      return;
    }

    reserva.remove();
    await espetaculo.save();

    response.status(OK).send();
  }
}
