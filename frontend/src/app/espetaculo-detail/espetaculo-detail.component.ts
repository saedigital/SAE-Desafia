import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { EspetaculosService } from '../services/espetaculos.service';
import {Location} from '@angular/common';

@Component({
  selector: 'app-espetaculo-detail',
  templateUrl: './espetaculo-detail.component.html',
  styleUrls: ['./espetaculo-detail.component.css']
})
export class EspetaculoDetailComponent implements OnInit {

  public espetaculo : any;
  public titulo: string;
  public descricao: string;
  public total_de_poltronas: string;

  constructor(
    private route: ActivatedRoute,
    private router: Router,
    private espetaculoService: EspetaculosService,
    private _location: Location
  ) { }

  ngOnInit() {
    this.route.params.subscribe(params => {
      this.get(params.id)
    })
  }

  get(id){
    this.espetaculoService.get(id).then((data)=>{
      this.espetaculo = data;
    })
  }

  cancelar(){
    this.espetaculoService.delete(this.espetaculo.id).then((data)=>{
      this._location.back();
      this.espetaculo = data;
    })
  }

  editar(){
    let data = {
      titulo: this.titulo ? this.titulo : this.espetaculo.descricao ,
      descricao: this.descricao ? this.descricao : this.espetaculo.descricao,
      total_de_poltronas: this.espetaculo.total_de_poltronas
    }
    this.espetaculoService.update(this.espetaculo.id, data).then((data)=>{
      this.get(data['id'])
    })
  }

}
