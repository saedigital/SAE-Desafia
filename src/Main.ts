import express, { Router } from "express";
import http from "http";
import cors from "cors";
import compression from "compression";
import helmet = require("helmet");
import bodyParser = require("body-parser");
import * as expressValidator from "express-validator";

import * as Env from "./Env";
import { ControllerEspetaculos} from "Controllers/ControllerEspetaculos";
import mongoose from "mongoose";

class Main {
  private expressApplication!: express.Application;
  private httpServer!: http.Server;

  public constructor() {
    this.connectToMongo();
    this.createExpressServer();
    this.listen();
  }

  private connectToMongo() {
    mongoose
      .connect(Env.DB_URI, {
        useNewUrlParser: true
      })
      .then(() => {
        console.log("Connected to mongoDB Database");
      })
      .catch(err => {
        console.log("Failed to connect to mongoDB: " + err);

        process.exit();
      });
  }

  private createExpressServer() {
    this.expressApplication = express();

    // Express configuration
    this.expressApplication.set("port", Env.PORT || 3000);
    this.expressApplication.use(helmet());
    this.expressApplication.use(
      cors({
        origin: Env.CORS
      })
    );
    this.expressApplication.use(compression());
    this.expressApplication.use(bodyParser.json());
    //this.app.use(bodyParser.urlencoded({ extended: true }));
    this.expressApplication.use(expressValidator.default());
    this.expressApplication.options(
      "*",
      cors({
        origin: Env.CORS
      })
    );
  }
  private listen() {
    this.httpServer = new http.Server(this.expressApplication);
    this.httpServer.listen(Env.PORT);

    if (this.httpServer.listening) {
      console.log(
        "Server is running at http://localhost:%d in %s mode",
        this.expressApplication!.get("port"),
        this.expressApplication!.get("env")
      );
    } else {
      console.error("Failed to bind to port " + Env.PORT);
      process.exit();
    }
  }

  public getExpressServer() {
    return this.expressApplication;
  }
}

const app = new Main();
const apiRouter = Router();

new ControllerEspetaculos().registrarEndpoints(apiRouter);
app.getExpressServer().use("/api", apiRouter);

// Web endpoints
app.getExpressServer().use(express.static("public"));
export default app;
