import { Document, Schema, model, DocumentQuery, Model, Types, } from "mongoose";
import { IReserva, Reserva, SchemaReserva } from "./Reserva";

export interface IEspetaculo extends Document{
  nome: string;
  numeroAssentos: number;
  preco: number;

  reservas: Types.DocumentArray<IReserva>;
}

export const SchemaEspetaculo = new Schema({
  nome: {
    type: String,
    required: true
  },

  numeroAssentos: {
    type: String,
    required: true
  },

  preco: {
    type: Number,
    required: true
  },

  reservas: [SchemaReserva]
}, {
  timestamps: true
});

export const Espetaculo = model<IEspetaculo>("Espetaculo", SchemaEspetaculo, "Espetaculos");