import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute } from '@angular/router';
import { EspetaculosService } from '../services/espetaculos.service';

@Component({
  selector: 'app-espetaculos-list',
  templateUrl: './espetaculos-list.component.html',
  styleUrls: ['./espetaculos-list.component.css']
})
export class EspetaculosListComponent implements OnInit {

  public espetaculos: any;
  public titulo: string;
  public descricao: string;
  public total_de_poltronas: string;

  constructor(
    private route: ActivatedRoute,
    private router: Router,
    private espetaculosService: EspetaculosService
  ) { }

  ngOnInit() {
    // TODO adicionar authguard posteriormente e proteger todas as rotas
    let token = window.localStorage.getItem('token')
    if (token){
      this.getAll()  
    }
    else{
      this.router.navigate(['login']); 
    }
    
  }
  
  getAll(){
    this.espetaculosService.getAll().then((response)=>{
      this.espetaculos = response['results'];
    })
  }
  
  criarEspetaculo(){
    let data = {
      titulo: this.titulo,
      descricao: this.descricao,
      total_de_poltronas: this.total_de_poltronas ? this.total_de_poltronas : 10
    }
    this.espetaculosService.create(data).then((response)=>{
      this.getAll()
    })
  }

  isLogged(){

  }

}
