import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppComponent } from './app.component';
import { routing } from './app.routes';
import { HttpClientModule } from '@angular/common/http';
import { EspetaculosListComponent } from './espetaculos-list/espetaculos-list.component';
import { EspetaculosService } from './services/espetaculos.service';
import { ReservasListComponent } from './reservas-list/reservas-list.component';
import { ReservasService } from './services/reservas.service';
import { PoltronasListComponent } from './poltronas-list/poltronas-list.component';
import { PoltronasService } from './services/poltronas.service';
import { PoltronasDetailComponent } from './poltronas-detail/poltronas-detail.component';
import { ReservasDetailComponent } from './reservas-detail/reservas-detail.component';
import { EspetaculoDetailComponent } from './espetaculo-detail/espetaculo-detail.component';

@NgModule({
  declarations: [
    AppComponent,
    EspetaculosListComponent,
    ReservasListComponent,
    PoltronasListComponent,
    PoltronasDetailComponent,
    ReservasDetailComponent,
    EspetaculoDetailComponent
  ],
  imports: [
    routing,
    BrowserModule,
    HttpClientModule,
  ],
  providers: [
    HttpClientModule, 
    EspetaculosService, 
    ReservasService,
    PoltronasService,
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
