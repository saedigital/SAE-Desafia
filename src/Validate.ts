import { Request, Response, NextFunction } from "express";
import { validationResult } from "express-validator/check";
import * as HttpStatusCode from "http-status-codes";

export function Validate(
  request: Request,
  response: Response,
  next: NextFunction
): void {
  const errors = validationResult(request);

  if (!errors.isEmpty()) {
    let error = errors.array({
      onlyFirstError: true
    })[0] as any;

    let errorMessage = {
      parameter: error.param,
      message: error.msg
    };

    response.status(HttpStatusCode.UNPROCESSABLE_ENTITY).send({
      error: errorMessage
    });

    //next(false);
  } else {
    next();
  }
}
