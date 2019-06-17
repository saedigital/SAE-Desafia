import { Document, Schema, model } from "mongoose";

export interface IReserva extends Document {
  numeroCadeira: number;

  nomePessoa: string;
  email: string;
}

export const SchemaReserva = new Schema(
  {
    nomePessoa: {
      type: String,
      required: true
    },
    email: {
      type: String,
      required: true
    },
    numeroCadeira: {
      type: Number,
      required: true
    }
  },
  { timestamps: true }
);

export const Reserva = model<IReserva>("Reserva", SchemaReserva);
