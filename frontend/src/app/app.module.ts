import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';

import { AppComponent } from './app.component';
import { routing } from './app.routes';
import { HttpClientModule } from '@angular/common/http';
import { EspetaculosListComponent } from './espetaculos-list/espetaculos-list.component';
import { EspetaculosService } from './services/espetaculos.service';
import { ReservasService } from './services/reservas.service';
import { PoltronasListComponent } from './poltronas-list/poltronas-list.component';
import { PoltronasService } from './services/poltronas.service';
import { PoltronasDetailComponent } from './poltronas-detail/poltronas-detail.component';
import { EspetaculoDetailComponent } from './espetaculo-detail/espetaculo-detail.component';
import { SweetAlert2Module } from '@toverux/ngx-sweetalert2';
import { LoginComponent } from './login/login.component';
import { SignupComponent } from './signup/signup.component';

@NgModule({
  declarations: [
    AppComponent,
    EspetaculosListComponent,
    PoltronasListComponent,
    PoltronasDetailComponent,
    EspetaculoDetailComponent,
    LoginComponent,
    SignupComponent
  ],
  imports: [
    routing,
    FormsModule,
    BrowserModule,
    HttpClientModule,
    SweetAlert2Module.forRoot()
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
